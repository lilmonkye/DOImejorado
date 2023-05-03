<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Numero;
use Illuminate\Support\Facades\Auth;

class MenuselecNumeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idrevista)
    {
        $numero = Numero::where('idrevista',$idrevista)->orderBy('created_at', 'desc')->first();
        return view('otro.menuselecnumero',['idnumero'=>$numero->id]);
    }


}
