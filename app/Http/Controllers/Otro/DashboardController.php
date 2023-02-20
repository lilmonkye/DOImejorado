<?php

namespace App\Http\Controllers\Otro;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct() {
        $this->middleware('role:otro');
    }
    public function index() {
        return view('otro.dashboard');
    }
    public function solicitar()
    {
        return view('otro.solicitar');
    }
    public function tsolicitudes()
    {
        return view('otro.tsolicitudes');
    }
    public function userdoi()
    {
        return view('otro.userdoi');
    }
}
