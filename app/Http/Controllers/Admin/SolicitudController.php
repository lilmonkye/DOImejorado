<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
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
