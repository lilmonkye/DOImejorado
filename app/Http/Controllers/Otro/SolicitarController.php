<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
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
}
