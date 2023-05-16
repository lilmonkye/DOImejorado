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


        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $idrevista;
        $solicitud->idarticulo = $idarticulo;
        $solicitud->estatus="pendiente";
        $solicitud->save();
        return redirect()->route('otro.solicitar');


    }

    //solicitar numero
    protected function solicitarNumerodR($idnumero)
    {
        $useract = Auth::user();

        $idrevista = Numero::where('id',$idnumero)->value('idrevista');

        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $idrevista;
        $solicitud->idnumero  = $idnumero;
        $solicitud->estatus="inicio";
        $solicitud->save();
        return redirect()->route('otro.solicitar');


    }

    //solicitar numero
    protected function solicitarArticulodN($idrevista)
    {
        $useract = Auth::user();



        $revista = Revista::findOrFail($idrevista);

        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $revista->id;
        $solicitud->estatus="inicio";
        $solicitud->save();
        return redirect()->route('otro.solicitar');


    }



}
