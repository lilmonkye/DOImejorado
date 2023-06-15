<?php

namespace App\Http\Controllers\Otro;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Numero;
use App\Models\Solicitud;
use App\Models\User;
use App\Notifications\StatusChanged;
use Illuminate\Support\Facades\Notification;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitarController extends Controller
{


    protected $table = 'solicituds';

    protected $primaryKey = 'id';


    //solicitar solo revista
    protected function solicitarRevista($idrevista)
    {
        $useract = auth()->user()->id;

        $solicitud = new Solicitud();

        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $idrevista;
        $solicitud->estatus='pendiente';
        $solicitud->save();
         //obtiene el id del usuario Asignador y su correo
        $role = 'asignador';
        $idasignador = User::where('role',$role)->inRandomOrder()->first();;
        $email = $idasignador->email;
        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));

        return redirect()->route('otro.solicitar');


    }

    //solicitar articulo de revista
    protected function solicitarArticulodR($idarticulo)
    {
        $useract = auth()->user()->id;

        $idrevista = Articulo::where('id',$idarticulo)->value('idrevista');

        $existe = Solicitud::where('idrevista',$idrevista)->exists();

        if($existe){
            $solicitud = new Solicitud();

            $solicitud->idusuario = $useract;
            $solicitud->idarticulo = $idarticulo;
            $solicitud->estatus="pendiente";
            $solicitud->save();
            //obtiene el id del usuario Asignador y su correo
            $role = 'asignador';
            $idasignador = User::where('role',$role)->inRandomOrder()->first();;
            $email = $idasignador->email;
            Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));

            return redirect()->route('otro.solicitar');
        }else{
            for($i=0;$i<2;$i++){
                $solicitud = new Solicitud();

                if($i == 1){
                    $solicitud->idusuario = $useract;
                    $solicitud->idarticulo = $idarticulo;
                    $solicitud->estatus="pendiente";
                    $solicitud->save();
                   //obtiene el id del usuario Asignador y su correo
                    $role = 'asignador';
                    $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                    $email = $idasignador->email;
                    Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                }else{
                    $solicitud->idusuario = $useract;
                    $solicitud->idrevista = $idrevista;
                    $solicitud->estatus="pendiente";
                    $solicitud->save();
                   //obtiene el id del usuario Asignador y su correo
                   $role = 'asignador';
                   $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                   $email = $idasignador->email;
                   Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                }
            }
            return redirect()->route('otro.solicitar');
        }

    }

    //solicitar numero
    protected function solicitarNumerodR($idnumero)
    {
        $useract = auth()->user()->id;

        $idrevista = Numero::where('id',$idnumero)->value('idrevista');

        $existe = Solicitud::where('idrevista',$idrevista)->exists();

        if($existe){
            $solicitud = new Solicitud();
            $solicitud->idusuario = $useract;
            $solicitud->idnumero = $idnumero;
            $solicitud->estatus = "pendiente";
            $solicitud->save();
           //obtiene el id del usuario Asignador y su correo
           $role = 'asignador';
           $idasignador = User::where('role',$role)->inRandomOrder()->first();;
           $email = $idasignador->email;
           Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
            return redirect()->route('otro.solicitar');
        }else{
            for($i = 0; $i < 2; $i++){
                $solicitud = new Solicitud();
                if($i == 1){
                    $solicitud->idusuario = $useract;
                    $solicitud->idnumero = $idnumero;
                    $solicitud->estatus = "pendiente";
                    $solicitud->save();
                    //obtiene el id del usuario Asignador y su correo
                    $role = 'asignador';
                    $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                    $email = $idasignador->email;
                    Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                }else{
                    $solicitud->idusuario = $useract;
                    $solicitud->idrevista = $idrevista;
                    $solicitud->estatus = "pendiente";
                    $solicitud->save();
                    //obtiene el id del usuario Asignador y su correo
                    $role = 'asignador';
                    $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                    $email = $idasignador->email;
                    Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                }
            }
            return redirect()->route('otro.solicitar');
        }


    }

    //solicitar articulo de numero
    protected function solicitarArticulodN($idarticulo)
    {
        $idarticulos = session('idarticulos');

        $useract = auth()->user()->id;

        $idnumero = Articulo::where('id',$idarticulo)->value('idnumero');

        $idrevista = Numero::where('id',$idnumero)->value('idrevista');

        $existerevista = Solicitud::where('idrevista',$idrevista)->exists();
        $existenumero = Solicitud::where('idnumero',$idnumero)->exists();

        if($existerevista and $existenumero){
            foreach ($idarticulos as $idarticulo) {
                $solicitud = new Solicitud();
                $solicitud->idusuario = $useract;
                $solicitud->idrevista = $idrevista;
                $solicitud->idarticulo = $idarticulo;
                $solicitud->estatus = "pendiente";
                $solicitud->save();
                //obtiene el id del usuario Asignador y su correo
                $role = 'asignador';
                $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                $email = $idasignador->email;
                Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
            }
            session()->forget('idarticulos');
            return redirect()->route('otro.solicitar');
        }elseif($existerevista){
            for($i = 0; $i < 2; $i++){
                if($i == 1){
                    foreach ($idarticulos as $idarticulo) {
                        $solicitud = new Solicitud();
                        $solicitud->idusuario = $useract;
                        $solicitud->idrevista = $idrevista;
                        $solicitud->idarticulo = $idarticulo;
                        $solicitud->estatus = "pendiente";
                        $solicitud->save();
                        //obtiene el id del usuario Asignador y su correo
                        $role = 'asignador';
                        $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                        $email = $idasignador->email;
                        Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                    }
                    session()->forget('idarticulos');
                }else{
                    $solicitud = new Solicitud();
                    $solicitud->idusuario = $useract;
                    $solicitud->idrevista = $idrevista;
                    $solicitud->idnumero = $idnumero;
                    $solicitud->estatus = "pendiente";
                    $solicitud->save();
                    //obtiene el id del usuario Asignador y su correo
                    $role = 'asignador';
                    $idasignador = User::where('role',$role)->inRandomOrder()->first();;
                    $email = $idasignador->email;
                    Notification::route('mail', $email)->notify(new StatusChanged($solicitud->estatus, $email));
                }
            }
            return redirect()->route('otro.solicitar');
        }


    }


    public function show(){
        $useract = auth()->user()->id;
        $solicituds = Solicitud::where('solicituds.idusuario',$useract)->
        leftJoin('articulos', 'solicituds.idarticulo','=','articulos.id')->
        leftJoin('numeros','solicituds.idnumero','=','numeros.id')->
        leftJoin('revistas','solicituds.idrevista','=','revistas.id')->
        select('solicituds.id',
            DB::raw('CASE
                    WHEN solicituds.idnumero IS NOT NULL THEN numeros.titulo
                    WHEN solicituds.idarticulo IS NOT NULL THEN articulos.titulo
                    ELSE revistas.titulo
                    END AS nombre_solicitud'),
                    'solicituds.estatus',
                    'solicituds.observaciones',
                    'solicituds.doicreado'
        )
        ->get();



        return view('otro.tsolicitudes',['solicituds'=>$solicituds]);
    }



}
