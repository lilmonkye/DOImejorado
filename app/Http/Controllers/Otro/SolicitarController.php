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

    /* public function store(Request $request)
{
    $solicitud = new Solicitud;
    $solicitud->user_id = auth()->user()->id;
    //$solicitud->campo1 = $request->input('campo1');
    //h$solicitud->campo2 = $request->input('campo2');
    // ...
    $solicitud->save();

    return redirect()->route('solicitudes.index');
} */
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Solicitud
     */
    protected function create(Request $request)
    {
        $idUsuario = $request->input('idusuario');
        $idRevista = $request->input('idrevista');
        $user = User::findOrFail($idUsuario);
        $revista = Revista::findOrFail($idRevista);

        $solicitud = new Solicitud();
        $solicitud->idusuario = $user->id;
        $solicitud->idrevista = $revista->id;
        $solicitud->estatus="inicio";
        $solicitud->save();
        return redirect()->back()->with('success', 'Solicitud creada correctamente');

        /* $idUsuario = $request->input('idusuario');
        $idRevista = $request->input('idrevista');

        $usuario = User::find($idUsuario);
        $revista = Revista::find($idRevista);

        if (!$usuario || !$revista) {
            return redirect()->back()->with('error', 'No se pudo encontrar al usuario o la revista');
        }

        $solicitud = new Solicitud();

        $solicitud->idusuario = $idUsuario;
        $solicitud->idrevista = $idRevista;
        $solicitud->estatus="inicio";
        $solicitud->save();
        //$numsolicitud = $solicitud->id;

        return redirect()->back()->with('success', 'Solicitud creada correctamente'); */

    }




}
