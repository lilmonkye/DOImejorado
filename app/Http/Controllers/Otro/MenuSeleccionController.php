<?php


namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
use App\Models\Articulo;
use Illuminate\Support\Facades\Auth;


class MenuSeleccionController extends Controller
{
    public function index()
    {

        // Buscar la última revista creada por el usuario actual
        $useract = Auth::user();
        $revista = Revista::where('idusuario', $useract->id)->orderBy('created_at', 'desc')->first();

        // Pasar datos a la vista
        return view('otro.menuseleccion', ['idrevista' => $revista->id]);
    }

    //menus de contribuidores

    //menu contribuidor de un articulo de revista
    public function menuseleccontr($idrevista)
    {
        $articulo = Articulo::where('idrevista',$idrevista)->orderBy('created_at', 'desc')->first();
        return view('otro.menuseleccontr',['idarticulo'=> $articulo->id]);
    }

    //menu contribuidor de un articulo de numero
    public function menuseleccontrnum($idnumero)
    {
        $articulo = Articulo::where('idnumero',$idnumero)->orderBy('created_at', 'desc')->first();
        return view('otro.menuseleccontrnum',['idarticulo'=> $articulo->id]);
    }
}
