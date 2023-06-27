<?php

namespace App\Http\Controllers\Asignador;


use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\User;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\DB;

class AsignarController extends Controller
{
    //
    public function __construct() {
        $this->middleware('role:asignador');
    }
    public function showSolicitudes() {

        $estatus = 'pendiente';

        $solicituds = Solicitud::where('solicituds.estatus',$estatus)->
        leftJoin('articulos', 'solicituds.idarticulo','=','articulos.id')->
        leftJoin('numeros','solicituds.idnumero','=','numeros.id')->
        leftJoin('revistas','solicituds.idrevista','=','revistas.id')->
        leftJoin('users','solicituds.idusuario','=','users.id')->
        select('solicituds.id',
            DB::raw('CASE
                    WHEN solicituds.idnumero IS NOT NULL THEN numeros.titulo
                    WHEN solicituds.idarticulo IS NOT NULL THEN articulos.titulo
                    ELSE revistas.titulo
                    END AS nombre_solicitud'),
                    'users.name',
                    'solicituds.estatus',
        )
        ->get();

        return view('asignador.tsolicitudes',['solicituds'=>$solicituds]);
    }

    public function showRevisores($id){

        $role = 'revisor';

        $revisores = User::where('role',$role)->get();

        $idsolicitud = $id;

        return view('asignador.trevisores',['revisores'=>$revisores,'id'=>$idsolicitud]);

    }

    public function asignar($idrevisor,$idsolicitud){
        $solicitud = Solicitud::find($idsolicitud);

        $solicitud->estatus="asignada";
        $solicitud->idrevisor=$idrevisor;

        $solicitud->save();
        //encuentra el id del revisor
        $idrevisor = $solicitud->idrevisor;
        $user = User::find($idrevisor);
        $email = $user->email;
        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email, $idsolicitud));

        return redirect()->route('asignador.tsolicitudes');
    }
}
