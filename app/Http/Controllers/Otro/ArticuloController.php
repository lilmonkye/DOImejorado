<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Articulo;

class ArticuloController extends Controller
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
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        // guardar el artículo
        $revista = Revista::findOrFail($id);
        $articulo = new Articulo();
        $articulo->titulo = $request->titulo;
        $articulo->doi = $request->doi;
        $articulo->url = $request->url;
        $articulo->fechaimp = $request->fechaimp;
        $articulo->fechadig = $request->fechadig;
        $articulo->primerpag = $request->primerpag;
        $articulo->ultimapag = $request->ultimapag;
        $articulo->abstract = $request->abstract;
        $articulo->idrevista = $revista;
        $datosArticulo = request()->except('_token','bandoi');
        $datosArticulo['idrevista'] ;
        $articulo->save();

        return response()->json(['message' => 'Revista y artículo guardados exitosamente']);

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
