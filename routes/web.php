<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Artisan;
//use App\Http\Controllers\Admin\DashboardController;
//use App\Http\Controllers\Otro\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();
/*
Route::get('/admin_dashboard', 'Admin\DashboardController@index');
Route::get('/otro_dashboard', 'Otro\DashboardController@index');
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Vistas ADMIN
Route::get('/admin_dashboard', 'Admin\DashboardController@index')->middleware('role:admin')->name('admin_dashboard');
Route::get('/admin/solicituregist', 'Admin\DashboardController@solicituregist')->middleware('role:admin')->name('admin.solicituregist');
Route::get('/admin/solicitudoi', 'Admin\DashboardController@solicitudoi')->middleware('role:admin')->name('admin.solicitudoi');
Route::get('/admin/dois', 'Admin\DashboardController@dois')->middleware('role:admin')->name('admin.dois');

//Vistas Usuarios OTRO
Route::get('/otro_dashboard', 'Otro\DashboardController@index')->middleware('role:other')->name('otro_dashboard');
Route::get('/otro/solicitar', 'Otro\DashboardController@solicitar')->middleware('role:other')->name('otro.solicitar');
Route::get('/otro/tsolicitudes', 'Otro\DashboardController@tsolicitudes')->middleware('role:other')->name('otro.tsolicitudes');
Route::get('/otro/userdoi', 'Otro\DashboardController@userdoi')->middleware('role:other')->name('otro.userdoi');

/*
Route::middleware(['auth'])->group(function () {
    // Rutas protegidas van aquí
    Route::get('/admin_dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::get('/admin/solicituregist', [AdminController::class, 'solicituregist'])->name('admin.solicituregist');
});*/

