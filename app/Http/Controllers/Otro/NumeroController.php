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

            $numero = new Numero();
            $numero->numero = $request->input('numero');
            $numero->titulo = $request->titulo;
            $numero->doi = $request->doi;
            $numero->url = $request->url;
            $numero->fechaimpr = $request->input('fechaimpr');
            $numero->fechadig = $request->input('fechadig');
            $numero->numespecial = $request->numespecial;
            $numero->volumen = $request->input('volumen');
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

    public function showall()
    {
        $idusuario = Auth::user();
        $revistas = Revista::where('idusuario', $idusuario->id)->get();

        $todoslosnum = collect();
        foreach($revistas as $revista)
        {
            $numeros = Numero::where('idrevista',$revista->id)->get();
            $todoslosnum = $todoslosnum->concat($numeros);
        }
        return view('otro.tablanumeroall',['numeros'=>$todoslosnum]);

    }

    public function showregistro()
    {
        $idusuario = Auth::user();
        $revistas = Revista::where('idusuario', $idusuario->id)->get();

        $todoslosnum = collect();
        foreach($revistas as $revista)
        {
            $numeros = Numero::where('idrevista',$revista->id)->get();
            $todoslosnum = $todoslosnum->concat($numeros);
        }
        return view('otro.tnumerosedit',['numeros'=>$todoslosnum]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $numero = Numero::findOrFail($id);
        return view('otro.numeroformEdit',compact('numero'));
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
        $numero = Numero::findOrFail($id);
        $validator = Numero::validator($request->all());

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
             // Actualizar los atributos del modelo a partir de los valores recibidos del formulario
             $numero->numero = $request->input('numero');
             $numero->titulo = $request->input('titulo');
             $numero->url = $request->input('url');
             $numero->fechaimpr = $request->input('fechaimpr');
             $numero->fechadig = $request->input('fechadig');
             $numero->numespecial = $request->input('numespecial');
             $numero->volumen = $request->input('volumen');
             $numero->volumenurl = $request->input('volumenurl');


             // Guardar en la base de datos
             $numero->save();

             $msg = 'Articulo actualizado, en espera de revisión';
             $alertType = 'success';
             session()->flash('msg', $msg);
             session()->flash('alert-type', $alertType);

             // Redireccionar al usuario a la vista de detalles del artículo actualizado
             return redirect()->route('otro.tnumerosedit');
        }
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
