<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Numero;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;


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

            $useract = auth()->user()->id;
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

    public function aniadirArticulo($id)
    {
        //AÑADIR
        $idnumero = Numero::findOrFail($id);
        return redirect()->route('otro.articulo_createconnumero',['idnumero'=>$idnumero]);
    }

    public function aniadirContribuidor($id)
    {
        //
        $idnumero = Numero::findOrFail($id);
        return redirect()->route('otro.contribuidor_createconnum',['idnumero'=>$idnumero]);
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

        $existeSolicitud = Solicitud::where('idnumero',$id)->exists();
        // Se obtiene el id del usario actual
        $useract = auth()->user()->id;

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

             //Si existe la solicitud con el id del articulo cambia el estatus a pendiente
            if($existeSolicitud){

                $idsolicitud = Solicitud::where('idnumero',$id)->value('id');
                $solicitud = Solicitud::where('id',$idsolicitud)->first();
                $solicitud->estatus="pendiente";
                $solicitud->save();
                //obtiene el id del usuario Asignador y su correo
                $role = 'asignador';
                $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                $email = $idasignador->email;
                Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));

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
                Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
            }




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
