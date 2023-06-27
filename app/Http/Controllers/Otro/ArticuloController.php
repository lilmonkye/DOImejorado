<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Articulo;
use App\Models\Numero;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;

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
            $articulo->abstract = $request->input('abstract');
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
            $articulo->abstract = $request->input('abstract');
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
        $articulo = Articulo::find($id);
        return view('otro.articuloformEdit', compact('articulo'));
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
        // Obtener el artículo correspondiente al ID recibido en la ruta
        $articulo = Articulo::findOrFail($id);
        // Se verifica si existe una solicitud con el id del articulo
        $existeSolicitud = Solicitud::where('idarticulo',$id)->exists();
        // Se obtiene el id del usario actual
        $useract = auth()->user()->id;

        $validator = Articulo::validator($request->all());


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Actualizar los atributos del modelo a partir de los valores recibidos del formulario
            $articulo->titulo = $request->input('titulo');
            $articulo->url = $request->input('url');
            $articulo->fechaimpr = $request->input('fechaimpr');
            $articulo->fechadig = $request->input('fechadig');
            $articulo->primerpag = $request->input('primerpag');
            $articulo->ultimapag = $request->input('ultimapag');
            $articulo->abstract = $request->input('abstract');

            $articulo->save();
            //Si existe la solicitud con el id del articulo cambia el estatus a pendiente
            if($existeSolicitud){
                $idsolicitud = Solicitud::where('idarticulo',$id)->value('id');
                $solicitud = Solicitud::find($idsolicitud);
                $solicitud->estatus="pendiente";
                $solicitud->save();
                //obtiene el id del usuario Asignador y su correo
                $role = 'asignador';
                $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                $email = $idasignador->email;
                Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus,$email, $idsolicitud));

            }else{//Si no existe crea una solicitud nueva
                $solicitud = new Solicitud();

                $solicitud->idusuario = $useract;
                $solicitud->idarticulo = $id;
                $solicitud->estatus="pendiente";
                $solicitud->save();
                //obtiene el id del usuario Asignador y su correo
                $role = 'asignador';
                $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                $email = $idasignador->email;
                Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus,$email, $solicitud->id));
            }

            // Guardar en la base de datos la informacion del articulo


            $msg = 'Articulo actualizado, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            // Redireccionar al usuario a la vista de detalles del artículo actualizado
            return redirect()->route('otro.tarticulosedit');
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
