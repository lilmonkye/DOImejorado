<?php

namespace App\Http\Controllers\Revisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Models\Solicitud;

class RevisionController extends Controller
{
    //
    protected $table = 'solicituds';

    public function show(){
        $idusuario = Auth::user();
        $revisions = Solicitud::where('idrevisor',$idusuario->id)->get();
        return view('revisor.tsolicitudes',['revisions'=>$revisions]);
    }

    public function menu($id){

    }


}
