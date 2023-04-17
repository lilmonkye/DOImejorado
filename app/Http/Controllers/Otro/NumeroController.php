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

        $validator = Numero::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

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
            $numero->idrevista = $idrevista;

            $numero->save();

            $msg = 'Numero guardado, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);


            return redirect()->route('otro.menuselecnumero',['idrevista'=> $idrevista]);
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
        $numeros = Numero::where('idrevista',$idrevista)->get();
        return view('otro.tablanumero',['numeros'=>$numeros,'idrevista'=>$idrevista]);
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
