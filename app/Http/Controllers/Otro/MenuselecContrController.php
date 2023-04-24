<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Articulo;

use Illuminate\Http\Request;

class MenuselecContrController extends Controller
{
    //
    public function index($idrevista)
    {
        $articulo = Articulo::where('idrevista',$idrevista)->orderBy('created_at', 'desc')->first();
        return view('otro.menuseleccontr',['idarticulo'=> $articulo->id]);
    }

}
