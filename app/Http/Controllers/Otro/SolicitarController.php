<?php

namespace App\Http\Controllers\Otro;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\User;
use App\Models\Revista;


use Illuminate\Http\Request;

class SolicitarController extends Controller
{
    public function __construct() {
        $this->middleware('role:otro');
    }


    public function articuloform()
    {
        return view('otro.articuloform');
    }
    public function numeroform()
    {
        return view('otro.numeroform');
    }

    protected $table = 'solicituds';

    protected $primaryKey = 'id';



    protected function create(Request $request)
    {
        $useract = Auth::user();

        $idRevista = $request->input('idrevista');

        $revista = Revista::findOrFail($idRevista);

        $solicitud = new Solicitud();
        $solicitud->idusuario = $useract;
        $solicitud->idrevista = $revista->id;
        $solicitud->estatus="inicio";
        $solicitud->save();
        return redirect()->back()->with('success', 'Solicitud creada correctamente');


    }




}
