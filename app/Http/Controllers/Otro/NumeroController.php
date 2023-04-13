<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Numero;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class NumeroController extends Controller
{
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
        return view('otro.numeroform',compact('revista','idrevista'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idrevista)
    {

        $revista = Revista::findOrFail($idrevista);
        // guardar el artículo falta pasar el id de la revista
        $numero = new Numero();
        $numero->numero = $request->numero;
        $numero->titulo = $request->titulo;
        $numero->doi = $request->doi;
        $numero->url = $request->url;
        $numero->fechaimpr = $request->fechaimpr;
        $numero->fechadig = $request->fechadig;
        $numero->numespecial = $request->numespecial;
        $numero->volumen = $request->volumen;
        $numero->volumendoi = $request->volumendoi;
        $numero->volumenurl = $request->volumenurl;

        $msg = 'Articulo guardado, en espera de revisión';
        $alertType = 'success';
        session()->flash('msg', $msg);
        session()->flash('alert-type', $alertType);

        //$useract = Auth::user();
        //$numero = Numero::where('idrevista', $idrevista->id)->orderBy('created_at', 'desc')->first();

        return redirect()->route('otro.articulo_createconnumero',['idnumero'=> $numero->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
