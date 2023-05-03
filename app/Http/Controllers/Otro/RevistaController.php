<?php

namespace App\Http\Controllers\Otro;
use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class RevistaController extends Controller
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
        return view('otro.revistaform');
    }

    public function menuseleccion()
    {
        return view('otro.menuseleccion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('otro.revistaform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Revista::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $useract = Auth::user();
            $revista = new Revista();
            $revista->titulo = $request->input('titulo');
            $revista->tituloabr = $request->input('tituloabr');
            $revista->doi = $request->input('doi');
            $revista->url = $request->url;
            $revista->issnimp = $request->issnimp;
            $revista->issnelec = $request->issnelec;
            $revista->idioma = $request->idioma;
            $revista['idusuario'] = $useract->id;
            $datosRevista = request()->except('_token','bandoi');

            $revista->save();

            $msg = 'Revista guardada, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            return redirect()->route('otro.menuseleccion',['idrevista'=> $revista->id]);
        }
        /*
            si quiero mostrar en el mismo blade de registro el mensaje
            $notification = array(
            'msg' => 'Revista guardada, en espera de revisión',
            'alert-type' => 'success'
        ); */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $useract = Auth::user();
        $revistas = Revista::where('idusuario', $useract->id)->get();
        $url = route('otro.tablarevista', ['id' => $useract->id]);
        return view('otro.tablarevista',['revistas'=>$revistas,'url'=>$url]);
    }

    public function showregistro()
    {
        $useract = Auth::user();

        $revistas = Revista::where('idusuario',$useract->id)->get();

        return view('otro.trevistasedit',['revistas'=>$revistas]);

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

    /* Obtener usuario actual
    function getUsuario(){
        $useract = Auth::user();
        return $useract;
    } */

     /* function prueba(Request $request){
        $ticket = new Solicitud();
        $ticket->idusuario=1;
        $ticket->idrevista=1;
        $ticket->estatus="inicio";
        var_dump($ticket);
        var_dump($ticket->status);
        $ticket->save();
        die();

    } */


}
