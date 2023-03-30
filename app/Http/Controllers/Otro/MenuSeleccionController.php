<?php


namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revista;
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
}
