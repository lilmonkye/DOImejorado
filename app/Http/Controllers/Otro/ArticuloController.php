<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Articulo;
use App\Models\Numero;
use Illuminate\Support\Facades\Auth;

class ArticuloController extends Controller
{
    public function __construct() {
        $this->middleware('role:otro');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idrevista)
    {
        $revista = Revista::findOrFail($idrevista);
        return view('otro.articuloform', compact('revista','idrevista'));
    }

    public function createconnumero($idnumero)
    {
        $numero = Numero::findOrFail($idnumero);
        return view('otro.articuloformconnum',compact('numero','idnumero'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //GUARDA EL REGISTRO DEL ARTICULO ASOCIADO A UNA REVISTA
    public function store(Request $request,$idrevista)
    {
        $validator = Articulo::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $articulo = new Articulo();
            $articulo->titulo = $request->input('titulo');
            $articulo->doi = $request->input('doi');
            $articulo->url = $request->url;
            $articulo->fechaimpr = $request->input('fechaimpr');
            $articulo->fechadig = $request->input('fechadig');
            $articulo->primerpag = $request->primerpag;
            $articulo->ultimapag = $request->ultimapag;
            $articulo->abstract = $request->abstract;
            $articulo->idrevista = $idrevista;
            $datosArticulo = request()->except('_token','bandoi');
            $datosArticulo['idrevista'] ;
            $articulo->save();

            $msg = 'Articulo guardado, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            return redirect()->route('otro.menuseleccontr',['idrevista'=> $idrevista]);
        }

    }

    //GUARDA EL REGISTRO DEL ARTICULO ASOCIADO A UN NUMERO
    public function storeconnumero(Request $request,$idnumero)
    {
        $validator = Articulo::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{


            $articulo = new Articulo();
            $articulo->titulo = $request->input('titulo');
            $articulo->doi = $request->input('doi');
            $articulo->url = $request->url;
            $articulo->fechaimpr = $request->fechaimpr;
            $articulo->fechadig = $request->fechadig;
            $articulo->primerpag = $request->primerpag;
            $articulo->ultimapag = $request->ultimapag;
            $articulo->abstract = $request->abstract;
            $articulo->idnumero = $idnumero;
            $datosArticulo = request()->except('_token','bandoi');
            $datosArticulo['idnumero'] ;
            $articulo->save();

            $msg = 'Articulo guardado, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            return redirect()->route('otro.menuseleccontrnum',['idnumero'=> $idnumero]);
            //falta crear este menu
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idrevista)
    {
        //CON EL ID DE LA REVISTA MOSTRAMOS LOS ARTICULOS DE LA REVISTA
        $articulos = Articulo::where('idrevista',$idrevista)->get();
        return view('otro.tablaarticulo',['articulos'=> $articulos,'idrevista'=>$idrevista]);
    }

    public function showconnumero($idnumero)
    {
        //CON EL ID DEL NUMERO ACTUAL MOSTRAMOS LOS ARTICULOS DEL NUMERO
        $articulos = Articulo::where('idnumero',$idnumero)->get();
        return view('otro.tablaarticuloconnum',['articulos'=>$articulos, 'idnumero'=>$idnumero]);
    }

    public function showregistro()
    {
        //SE OBTIENE EL USUARIO ACTUAL
        $idusuario = Auth::user();
        //SE OBTIENEN LAS REVISTAS DEL USUARIO
        $revistas = Revista::where('idusuario', $idusuario->id)->get();
        //SE OBTIENEN TODOS LOS NUMEROS DE TODAS LAS REVISTAS DEL USUARIO
        $numeros = Numero::whereIn('idrevista', $revistas->pluck('id'))->get();

        //SE OBTIENEN LOS ARTICULOS DE LAS REVISTAS Y LOS NUMEROS
        $articulosRevistas = Articulo::whereIn('idrevista', $revistas->pluck('id'))->get();
        $articulosNumeros = Articulo::whereIn('idnumero', $numeros->pluck('id'))->get();

        //SE CONCATENAN TODOS LOS ARTICULOS
        $todoslosart = $articulosRevistas->concat($articulosNumeros);

        //SE ENVIA A LA VISTA TODOS LOS ARTICULOS
        return view('otro.tarticulosedit',['articulos'=>$todoslosart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
