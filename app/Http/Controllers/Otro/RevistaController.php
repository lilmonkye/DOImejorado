<?php

namespace App\Http\Controllers\Otro;
use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class RevistaController extends Controller
{
     public function __construct() {
        $this->middleware('role:otro');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('otro.revistaform');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('otro.revistaform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosRevista = request()->except('_token','bandoi');
        Revista::insert($datosRevista);
        return response()->json($datosRevista);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /* function prueba(Request $request){
        $ticket = new Solicitud();
        $ticket->idusuario=1;
        $ticket->idrevista=1;
        $ticket->estatus="inicio";
        var_dump($ticket);
        var_dump($ticket->status);
        $ticket->save();
        die();

    } */


}
