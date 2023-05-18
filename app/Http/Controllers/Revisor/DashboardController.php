<?php

namespace App\Http\Controllers\Revisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    protected $table = 'solicituds';
    public function __construct() {
        $this->middleware('role:revisor');
    }
    public function index() {
        return view('revisor.dashboard');
    }
}
