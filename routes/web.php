<?php

use App\Http\Controllers\Otro\RevistaController as OtroRevistaController;
use App\Http\Controllers\Otro\SolicitarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Artisan;
//use App\Http\Controllers\Admin\DashboardController;
//use App\Http\Controllers\Otro\DashboardController;
use App\Http\Controllers\RevistaController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rutas protegidas para el rol 'admin'
    Route::get('/admin_dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');
    Route::get('/admin/solicituregist', 'Admin\DashboardController@solicituregist')->name('admin.solicituregist');
    Route::get('/admin/solicitudoi', 'Admin\DashboardController@solicitudoi')->name('admin.solicitudoi');
    Route::get('/admin/dois', 'Admin\DashboardController@dois')->name('admin.dois');
});

Route::middleware(['auth', 'role:otro'])->group(function () {
    // Rutas protegidas para el rol 'otro'
    Route::get('/otro_dashboard', 'Otro\DashboardController@index')->name('otro_dashboard');
    Route::get('/otro/solicitar', 'Otro\DashboardController@solicitar')->name('otro.solicitar');
    Route::get('/otro/tsolicitudes', 'Otro\DashboardController@tsolicitudes')->name('otro.tsolicitudes');
    Route::get('/otro/userdoi', 'Otro\DashboardController@userdoi')->name('otro.userdoi');

});

Route::middleware(['auth', 'role:otro'])->group(function () {
    // Rutas protegidas para el rol 'otro'
    //Route::get('/otro/articuloform', 'Otro\SolicitarController@articuloform')->name('otro.articuloform');
    Route::get('/otro/numeroform', 'Otro\SolicitarController@numeroform')->name('otro.numeroform');
    Route::get('/otro_revistaform', 'Otro\RevistaController@index')->name('otro.revistaform');
    //Route::post('/otro_revista_prueba', 'Otro\SolicitarController@create')->name('otro.revista_prueba');
    //Route::post('/otro_solicitar_create', 'Otro\SolicitarController@create')->name('otro.solicitar_create');
    Route::get('/otro_menuseleccion/{idrevista}', 'Otro\MenuSeleccionController@index')->name('otro.menuseleccion');
    Route::post('/otro_revista_create', 'Otro\RevistaController@store')->name('otro.revista_create');
    Route::get('/otro/articulo/create/{idrevista}','Otro\ArticuloController@create')->name('otro.articulo_create');
    Route::post('/otro/articulo/store/{idrevista}','Otro\ArticuloController@store')->name('otro.articulo_store');


    Route::get('/otro/numero/create/{idrevista}','Otro\NumeroController@create')->name('otro.numero_create');
    Route::post('/otro/numero/store/{idrevista}','Otro\NumeroController@store')->name('otro.numero_store');
    Route::get('/otro/articulo/createconnumero/{idnumero}','Otro\ArticuloController@create')->name('otro.articulo_createconnumero');
    Route::post('/otro/articulo/storeconnumero/{idnumero}','Otro\ArticuloController@storeconnumeroconnumero')->name('otro.articulo_storeconnumero');
    Route::get('otro/contribuidor','Otro\ContribuidorController@index')->name('otro.contribuidorform');

    Route::get('otro/tablaarticulo/{idrevista}','Otro\ArticuloController@show')->name('otro.tablaarticulo');
    Route::get('otro/tablarevista/{id}','Otro\RevistaController@show')->name('otro.tablarevista');
});

