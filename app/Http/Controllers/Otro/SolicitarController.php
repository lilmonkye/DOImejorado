<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\User;

use Illuminate\Http\Request;

class SolicitarController extends Controller
{
    public function __construct() {
        $this->middleware('role:otro');
    }
    public function revistaform() {
        return view('otro.revistaform');
    }
    public function articuloform()
    {
        return view('otro.articuloform');
    }
    public function numeroform()
    {
        return view('otro.numeroform');
    }

    protected $table = 'solicitud';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idusuario',
        'revista',
        'estatus',
        'doicreado',
    ];
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Solicitud
     */
    protected function create(array $data)
    {
        $solicitudFields = [
            'idusuario' => $data['idusuario'],
            'revista' => $data['revista'],
            'estatus' => $data['estatus'],
            'doicreado' => $data['doicreado'],

        ];


        $solicitud = Solicitud::create($solicitudFields);

        return $solicitud;
    }


}
