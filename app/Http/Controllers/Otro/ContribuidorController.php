<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulo;
use App\Models\Contribuidor;
use App\Models\Numero;
use Illuminate\Http\Request;
use App\Models\Revista;

class ContribuidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('otro.contribuidorform');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idarticulo)
    {
        //contribuidor de articulo
        $articulo = Articulo::findOrFail($idarticulo);
        return view('otro.contribuidorform', compact('articulo','idarticulo'));
    }

    public function createconnumero($idnumero)
    {
        //contribuidor de numero
        $numero = Numero::findOrFail($idnumero);
        return view('otro.contribuidorformconnum',compact('numero','idnumero'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idarticulo)
    {
        //contribuidor de articulo
        $validator = Contribuidor::validator($request->all());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $contribuidor = new Contribuidor();
            $contribuidor->idarticulo = $idarticulo;
            $contribuidor->nombre = $request->input('nombre');
            $contribuidor->apellido = $request->input('apellido');
            $contribuidor->afiliacion = $request->input('afiliacion');
            $contribuidor->orcidid = $request->input('orcidid');
            $contribuidor->nomalternativo = $request->input('nomalternativo');
            $contribuidor->rol = $request->rol;

            $contribuidor->save();

            $msg = 'Contribuidor guardado correctamente';
            $alertType = 'success';
            session()->flash('msg',$msg);
            session()->flash('alert-type',$alertType);



            return redirect()->route('otro.tablacontribuidor', ['idarticulo'=> $idarticulo]);
        }

    }

    public function storeconnum(Request $request,$idnumero)
    {
        //contribuidor de articulo
        $validator = Contribuidor::validator($request->all());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $contribuidor = new Contribuidor();
            $contribuidor->idnumero = $idnumero;
            $contribuidor->nombre = $request->input('nombre');
            $contribuidor->apellido = $request->input('apellido');
            $contribuidor->afiliacion = $request->input('afiliacion');
            $contribuidor->orcidid = $request->input('orcidid');
            $contribuidor->nomalternativo = $request->input('nomalternativo');
            $contribuidor->rol = $request->rol;

            $contribuidor->save();

            $msg = 'Contribuidor guardado correctamente';
            $alertType = 'success';
            session()->flash('msg',$msg);
            session()->flash('alert-type',$alertType);

            $numero = Numero::find($idnumero);
            $idrevista = $numero->idrevista;

            return redirect()->route('otro.tablaarticuloconnum', ['idnumero'=> $idnumero]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idarticulo)
    {
        //contribuidor de articulo
        $contribuidors = contribuidor::where('idarticulo',$idarticulo)->get();
        return view('otro.tablacontribuidor',['contribuidors'=>$contribuidors,'idarticulo'=>$idarticulo]);
    }

    public function showconnum($idnumero)
    {
        //contribuidor de articulo
        $contribuidors = contribuidor::where('idnumero',$idnumero)->get();
        return view('otro.tablacontrcnum',['contribuidors'=>$contribuidors,'idnumero'=>$idnumero]);
    }

    public function showregistro()
    {
        //SE OBTIENE EL USUARIO ACTUAL
        $idusuario = Auth::user();
        //SE OBTIENEN LAS REVISTAS DEL USUARIO
        $revistas = Revista::where('idusuario', $idusuario->id)->get();
        //SE OBTIENEN LOS NÚMEROS
        $numeros = Numero::whereIn('idrevista',$revistas->pluck('id'))->get();
         //SE OBTIENEN LOS ARTICULOS DE LAS REVISTAS
        $articulosRevistas = Articulo::whereIn('idrevista',$revistas->pluck('id'))->get();
         //SE OBTIENEN LOS ARTICULOS DE LOS NUMEROS
        $articulosNumeros = Articulo::whereIn('idnumero',$numeros->pluck('id'))->get();

        //CONTIBUIDORES DE NUMEROS, ARTICULOS DE REVISTA Y ARTICULOS DE NUMERO
        $contribuidorNum = Contribuidor::whereIn('idnumero',$numeros->pluck('id'))->get();
        $contribuidorAR = Contribuidor::whereIn('idarticulo',$articulosRevistas->pluck('id'))->get();
        $contribuidorAN = Contribuidor::whereIn('idarticulo',$articulosNumeros->pluck('id'))->get();

        $todosloscontr = $contribuidorNum->concat($contribuidorAR)->concat($contribuidorAN);

        return view('otro.tcontribuidorsedit',['contribuidors'=>$todosloscontr]);

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
