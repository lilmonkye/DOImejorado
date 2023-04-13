<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Articulo;
use App\Models\Numero;

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
        return view('otro.articuloform',compact('numero','idnumero'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idrevista)
    {
        $validator = Articulo::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $revista = Revista::findOrFail($idrevista);
            // guardar el artículo falta pasar el id de la revista
            $articulo = new Articulo();
            $articulo->titulo = $request->titulo;
            $articulo->doi = $request->doi;
            $articulo->url = $request->url;
            $articulo->fechaimpr = $request->fechaimpr;
            $articulo->fechadig = $request->fechadig;
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

            return redirect()->route('otro.contribuidorform');
        }

    }

    public function storeconnumero(Request $request,$idnumero)
    {
        $validator = Articulo::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $revista = Revista::findOrFail($idnumero);
            // guardar el artículo falta pasar el id de la revista
            $articulo = new Articulo();
            $articulo->titulo = $request->titulo;
            $articulo->doi = $request->doi;
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

            return redirect()->route('otro.contribuidorform');
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
        //
        $articulos = Articulo::where('idrevista',$idrevista)->get();
        return view('otro.tablaarticulo',['articulos'=> $articulos,'idrevista'=>$idrevista]);
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
