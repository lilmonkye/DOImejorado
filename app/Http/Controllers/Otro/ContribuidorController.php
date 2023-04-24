<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Contribuidor;
use App\Models\Numero;
use Illuminate\Http\Request;

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
        return view('otro.articuloformconnum',compact('numero','idnumero'));
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
