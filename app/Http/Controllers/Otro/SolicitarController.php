<?php

namespace App\Http\Controllers\Otro;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Numero;
use App\Models\Solicitud;
use App\Models\User;
use App\Models\Revista;


use Illuminate\Http\Request;

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

            return redirect()->route('otro.solicitar');
        }else{
            for($i=0;$i<2;$i++){
                $solicitud = new Solicitud();

                if($i == 1){
                    $solicitud->idusuario = $useract;
                    $solicitud->idarticulo = $idarticulo;
                    $solicitud->estatus="pendiente";
                    $solicitud->save();
                }else{
                    $solicitud->idusuario = $useract;
                    $solicitud->idrevista = $idrevista;
                    $solicitud->estatus="pendiente";
                    $solicitud->save();
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
            return redirect()->route('otro.solicitar');
        }else{
            for($i = 0; $i < 2; $i++){
                $solicitud = new Solicitud();
                if($i == 1){
                    $solicitud->idusuario = $useract;
                    $solicitud->idnumero = $idnumero;
                    $solicitud->estatus = "pendiente";
                    $solicitud->save();
                }else{
                    $solicitud->idusuario = $useract;
                    $solicitud->idrevista = $idrevista;
                    $solicitud->estatus = "pendiente";
                    $solicitud->save();
                }
            }
            return redirect()->route('otro.solicitar');
        }


    }

    //solicitar articulo de numero
    protected function solicitarArticulodN($idarticulo)
    {
        //$idArticulosArray = explode(',',$idarticulos);

        $useract = auth()->user()->id;

        $idnumero = Articulo::where('id',$idarticulo)->value('idnumero');

        $idrevista = Numero::where('id',$idnumero)->value('idrevista');

        $existerevista = Solicitud::where('idrevista',$idrevista)->exists();
        $existenumero = Solicitud::where('idnumero',$idnumero)->exists();

        if($existerevista and $existenumero){
            $solicitud = new Solicitud();
            $solicitud->idusuario = $useract;
            $solicitud->idarticulo = $idarticulo;
            $solicitud->estatus="pendiente";
            $solicitud->save();
            return redirect()->route('otro.solicitar');
        }elseif($existerevista){
            for($i = 0; $i < 2; $i++){
                if($i == 1){

                }
            }

        }
        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $idrevista;
        $solicitud->idnumero  = $idnumero;
        $solicitud->idarticulo = $idarticulo;
        $solicitud->estatus="pendiente";
        $solicitud->save();
        return redirect()->route('otro.solicitar');


    }


    public function show(){
        $useract = Auth::user();
        $solicituds = Solicitud::where('idusuario',$useract->id)->get();
        return view('otro.tsolicitudes',['solicituds'=>$solicituds]);
    }



}
