<?php

namespace App\Http\Controllers\Asignador;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct() {
        $this->middleware('role:asignador');
    }
    public function index() {
        return view('asignador.dashboard');
    }
}
