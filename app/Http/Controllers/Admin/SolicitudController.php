<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\Revista;
use App\Models\Articulo;
use App\Models\Numero;
use App\Models\User;
use App\Models\Contribuidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $estatus = 'aprobado';
        // where estatus asignada y este asignada al usuario actual
        $solicituds = Solicitud::where([
        ['solicituds.estatus', '=', $estatus],
        ])
        ->leftJoin('articulos', 'solicituds.idarticulo','=','articulos.id')
        ->leftJoin('numeros','solicituds.idnumero','=','numeros.id')
        ->leftJoin('revistas','solicituds.idrevista','=','revistas.id')
        ->leftJoin('users','solicituds.idusuario','=','users.id')
        ->select('solicituds.id',
            DB::raw('CASE
                    WHEN solicituds.idnumero IS NOT NULL THEN numeros.titulo
                    WHEN solicituds.idarticulo IS NOT NULL THEN articulos.titulo
                    ELSE revistas.titulo
                    END AS nombre_solicitud'),
                    'users.name',
        )
        ->get();

        return view('admin.solicitudoi',['solicituds'=>$solicituds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Solicitud::find($id);
        if(!empty($solicitud->idrevista)){

            $idrevista = Solicitud::where('id',$id)->value('idrevista');

            $revistas = Revista::where('id',$idrevista)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('admin.trevista',['revistas'=>$revistas, 'solicituds'=>$solicituds]);

        }elseif($solicitud->idarticulo){
            //PARA ARTICULO

            $idarticulo = Solicitud::where('id',$id)->value('idarticulo');

            $articulos = Articulo::where('id',$idarticulo)->get();

            $contribuidores = Contribuidor::where('idarticulo',$idarticulo)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('admin.tarticulo',compact('articulos','contribuidores','solicituds'));

        }elseif($solicitud->idnumero){

            //PARA NUMERO
            $idnumero = Solicitud::where('id',$id)->value('idnumero');

            $numeros = Numero::where('id',$idnumero)->get();

            $contribuidores = Contribuidor::where('idnumero',$idnumero)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('admin.tnumero',compact('numeros','contribuidores','solicituds'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function guardarDoirev(Request $request, $idrevista)
    {

        $solicitud = Solicitud::where('idrevista',$idrevista)->first();
        $solicitud->doicreado = $request->input('doi');
        $solicitud->estatus = "finalizada";
        $solicitud->save();
//Encuentra el id del usuario que realiza la solicitud de doi (usuario Otro)
        $idusuario = $solicitud->idusuario;
        $user = User::find($idusuario);
        $email = $user->email;
        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email, $solicitud->id));

        return redirect()->route('admin.solicitudoi');
    }

    public function guardarDoiart(Request $request, $idarticulo)
    {

        $solicitud = Solicitud::where('idarticulo',$idarticulo)->first();
        $solicitud->doicreado = $request->input('doi');
        $solicitud->estatus = "finalizada";
        $solicitud->save();


        $idusuario = $solicitud->idusuario;
        $user = User::find($idusuario);
        $email = $user->email;
        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email, $solicitud->id));

        return redirect()->route('admin.solicitudoi');
    }

    public function guardarDoinum(Request $request, $idnumero)
    {

        $solicitud = Solicitud::where('idnumero',$idnumero)->first();
        $solicitud->doicreado = $request->input('doi');
        $solicitud->estatus = "finalizada";
        $solicitud->save();

        $idusuario = $solicitud->idusuario;
        $user = User::find($idusuario);
        $email = $user->email;
        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email, $solicitud->id));

        return redirect()->route('admin.solicitudoi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
