<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Articulo;
use App\Models\Contribuidor;
use App\Models\Numero;
use Illuminate\Http\Request;
use App\Models\Revista;
use Dotenv\Validator;
use PhpParser\Node\Stmt\Return_;

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

    public function createartcnum($idarticulo)
    {
        //contribuidor de articulo
        $articulo = Articulo::findOrFail($idarticulo);
        return view('otro.contribuidorartcnumform', compact('articulo','idarticulo'));
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

    public function storeartcnum(Request $request,$idarticulo)
    {
        //contribuidor de articulo denumero
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
           // $idnumero = Articulo::where('id',$idarticulo)->value('idnumero');

            $contribuidor->save();

            $msg = 'Contribuidor guardado correctamente';
            $alertType = 'success';
            session()->flash('msg',$msg);
            session()->flash('alert-type',$alertType);



            return redirect()->route('otro.tablacontrartcnum', ['idarticulo'=> $idarticulo]);
        }

    }

    public function storeconnum(Request $request,$idnumero)
    {
        //contribuidor de numero
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

            return redirect()->route('otro.tablacontrcnum', ['idnumero'=> $idnumero]);
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
        $idrevista = Articulo::where('id',$idarticulo)->value('idrevista');
        $contribuidors = contribuidor::where('idarticulo',$idarticulo)->get();
        return view('otro.tablacontribuidor',['contribuidors'=>$contribuidors,'idarticulo'=>$idarticulo,'idrevista'=>$idrevista]);
    }

    public function showconnum($idnumero)
    {
        //contribuidor de articulo
        $contribuidors = contribuidor::where('idnumero',$idnumero)->get();
        return view('otro.tablacontrcnum',['contribuidors'=>$contribuidors,'idnumero'=>$idnumero]);
    }

    public function showcontrnumart($idarticulo)
    {
        //contribuidor del articulo del numero
        $contribuidors = contribuidor::where('idarticulo',$idarticulo)->get();
        //numero en el que se encuentra el articulo que contiene al contribuidor
        $idnumero = Articulo::where('id',$idarticulo)->value('idnumero');

        /* dd($idarticulo); */

        return view('otro.tablacontrartcnum',['contribuidors'=>$contribuidors,'idnumero'=>$idnumero,'idarticulo'=>$idarticulo]);
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
        $contribuidor = Contribuidor::find($id);
        return view('otro.contribuidorformEdit', compact('contribuidor'));
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
        $contribuidor = Contribuidor::find($id);
        $validator = Contribuidor::validator($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $contribuidor->nombre = $request->input('nombre');
            $contribuidor->apellido = $request->input('apellido');
            $contribuidor->afiliacion = $request->input('afiliacion');
            $contribuidor->orcidid = $request->input('orcidid');
            $contribuidor->nomalternativo = $request->input('nomalternativo');
            $contribuidor->rol = $request->input('rol');

            $contribuidor->save();

            $msg = 'Contribuidor actualizado en espera de revisión';
            $alertType = 'success';
            session()->flash('msg',$msg);
            session()->flash('alertType',$alertType);

            return redirect()->route('otro.tcontribuidorsedit');
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
