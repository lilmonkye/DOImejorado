<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
      }
    public function index() {
        return view('admin.dashboard');
    }
    public function solicituregist()
    {
        return view('admin.solicituregist');
    }
    public function solicitudoi()
    {
        return view('admin.solicitudoi');
    }
    public function dois()
    {
        return view('admin.dois');
    }

}
