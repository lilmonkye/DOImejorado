<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    Route::get('/admin/solicitudoi', 'Admin\SolicitudController@index')->name('admin.solicitudoi');
    Route::get('/admin/dois', 'Admin\DashboardController@dois')->name('admin.dois');
    Route::get('/admin/userst','Admin\UserController@index')->name('admin.userst');
    Route::post('/admin/acces/{id}','Admin\UserController@cambiarRol')->name('admin.cambiarRol');
    Route::get('/admin/showsolicitud/{id}','Admin\SolicitudController@show')->name('admin.showsolicitud');
    Route::post('/admin/guardar-doirev/{idrevista}','Admin\SolicitudController@guardarDoirev')->name('admin.guardarDoirev');
    Route::post('/admin/guardar-doiart/{idarticulo}','Admin\SolicitudController@guardarDoiart')->name('admin.guardarDoiart');
    Route::post('/admin/guardar-doinum/{idnumero}','Admin\SolicitudController@guardarDoinum')->name('admin.guardarDoinum');
    Route::get('/admin/userform/{id}', 'Admin\UserController@edit')->name('admin.userEdit');
    Route::post('/admin/update/{id}','Admin\UserController@update')->name('admin.updateUser');
});

Route::middleware(['auth','role:revisor'])->group(function(){
    //Rutas protegidas para el rol 'revisor'
    Route::get('/revisor_dashboard', 'Revisor\DashboardController@index')->name('revisor_dashboard');
    Route::get('/revisor/tsolicitudes/','Revisor\RevisionController@show')->name('revisor.tsolicitudes');
    Route::get('/revisor/showsolicitud/{id}','Revisor\RevisionController@showsolicitud')->name('revisor.showsolicitud');
    Route::post('revisor/guardar-observacion/{idarticulo}', 'Revisor\RevisionController@guardar')->name('revisor.guardar-observacion');
    Route::post('revisor/guardar-observacionrev/{idrevista}', 'Revisor\RevisionController@guardarRevista')->name('revisor.guardar-revista');
    Route::post('revisor/guardar-observacionnum/{idnumero}', 'Revisor\RevisionController@guardarNumero')->name('revisor.guardar-numero');
    Route::get('/revisor/aprobadoRev/{idrevista}','Revisor\RevisionController@aprobarRevista')->name('revisor.aprobarRevista');
    Route::get('/revisor/aprobadoArt/{idarticulo}','Revisor\RevisionController@aprobarArticulo')->name('revisor.aprobarArticulo');
    Route::get('/revisor/aprobadoNum/{idnumero}','Revisor\RevisionController@aprobarNumero')->name('revisor.aprobarNumero');
});

Route::middleware(['auth','role:asignador'])->group(function(){
    //RUTAS PROTEGIDAS PARA EL ROL 'asignador'
    Route::get('/asignador_dashboard','Asignador\DashboardController@index')->name('asignador_dashboard');
    Route::get('/asignador/tsolicitudes','Asignador\AsignarController@showSolicitudes')->name('asignador.tsolicitudes');
    Route::get('/asignador/trevisores/{id}','Asignador\AsignarController@showRevisores')->name('asignador.trevisores');
    Route::get('/asignador/asignar/{idrevisor}/{idsolicitud}','Asignador\AsignarController@asignar')->name('asignador.asignar');
});

Route::middleware(['auth', 'role:otro'])->group(function () {
    // Rutas protegidas para el rol 'otro' SOLO DASHBOARD
    Route::get('/otro_dashboard', 'Otro\DashboardController@index')->name('otro_dashboard');
    Route::get('/otro/solicitar', 'Otro\DashboardController@solicitar')->name('otro.solicitar');
    Route::get('/otro/tsolicitudes', 'Otro\SolicitarController@show')->name('otro.tsolicitudes');
    Route::get('/otro/userdoi', 'Otro\DashboardController@userdoi')->name('otro.userdoi');
    Route::get('/otro/registros', 'Otro\DashboardController@registros')->name('otro.registros');

});

//REGISTROS
Route::middleware(['auth', 'role:otro'])->group(function () {
    //EDITAR INFORMACIÓN
    //Tablas edit
    Route::get('/otro/trevistastodas', 'Otro\RevistaController@showregistro')->name('otro.trevistasedit');
    Route::get('/otro/tarticulostodos', 'Otro\ArticuloController@showregistro')->name('otro.tarticulosedit');
    Route::get('/otro/tnumerostodos', 'Otro\NumeroController@showregistro')->name('otro.tnumerosedit');
    Route::get('/otro/tcontribuidorstodos', 'Otro\ContribuidorController@showregistro')->name('otro.tcontribuidorsedit');
    //Formularios edit
    Route::get('/otro/articuloEdit/{id}', 'Otro\ArticuloController@edit')->name('otro.articuloEdit');
    Route::get('/otro/revistaEdit/{id}', 'Otro\RevistaController@edit')->name('otro.revistaEdit');
    Route::get('/otro/numeroEdit/{id}', 'Otro\NumeroController@edit')->name('otro.numeroEdit');
    Route::get('/otro/contribuidorEdit/{id}', 'Otro\ContribuidorController@edit')->name('otro.contribuidorEdit');
    //ActualizarInformación(botones)
    Route::post('/otro/articuloUpdate/{id}', 'Otro\ArticuloController@update')->name('otro.articuloUpdate');
    Route::post('/otro/revistaUpdate/{id}', 'Otro\RevistaController@update')->name('otro.revistaUpdate');
    Route::post('/otro/numeroUpdate/{id}', 'Otro\NumeroController@update')->name('otro.numeroUpdate');
    Route::post('/otro/contribuidorUpdate/{id}', 'Otro\ContribuidorController@update')->name('otro.contribuidorUpdate');

});

//AGREGAR ARTICULO, NUMERO, CONTRIBUIDOR (MIS REVISTAS Y MIS NUMEROS)
Route::middleware(['auth','role:otro'])->group(function(){
    //AÑADIR ARTICULO O NUMERO A UNA REVISTA EXISTENTE
    Route::get('/otro/aniadirArticulo/{idrevista}', 'Otro\RevistaController@aniadirArticulo')->name('otro.aniadirArticulo');
    Route::get('/otro/aniadirNumero/{idrevista}', 'Otro\RevistaController@aniadirNumero')->name('otro.aniadirNumero');
    //AÑADIR ARTICULO O CONTRIBUIDOR A UN NUMERO EXISTENTE
    Route::get('/otro/aniadirArticulonum/{idnumero}', 'Otro\NumeroController@aniadirArticulo')->name('otro.aniadirArticulonum');
    Route::get('/otro/aniadirContribuidor/{idnumero}', 'Otro\NumeroController@aniadirContribuidor')->name('otro.aniadirContribuidor');
});

Route::middleware(['auth', 'role:otro'])->group(function () {
    // Rutas protegidas para el rol 'otro'
    // REGISTAR DE INFORMACIÓN

    Route::get('/otro/numeroform', 'Otro\SolicitarController@numeroform')->name('otro.numeroform');
    Route::get('/otro_revistaform', 'Otro\RevistaController@index')->name('otro.revistaform');

    Route::get('/otro_menuseleccion/{idrevista}', 'Otro\MenuSeleccionController@index')->name('otro.menuseleccion');
    Route::post('/otro_revista_create', 'Otro\RevistaController@store')->name('otro.revista_create');
    Route::get('/otro/articulo/create/{idrevista}','Otro\ArticuloController@create')->name('otro.articulo_create');
    Route::post('/otro/articulo/store/{idrevista}','Otro\ArticuloController@store')->name('otro.articulo_store');


    Route::get('/otro/numero/create/{idrevista}','Otro\NumeroController@create')->name('otro.numero_create');
    Route::post('/otro/numero/store/{idrevista}','Otro\NumeroController@store')->name('otro.numero_store');
    Route::get('/otro/articulo/createconnumero/{idnumero}','Otro\ArticuloController@createconnumero')->name('otro.articulo_createconnumero');
    Route::post('/otro/articulo/storeconnumero/{idnumero}','Otro\ArticuloController@storeconnumero')->name('otro.articulo_storeconnumero');
    Route::get('otro/contribuidor','Otro\ContribuidorController@index')->name('otro.contribuidorform');

    Route::get('otro/tablaarticulo/{idrevista}','Otro\ArticuloController@show')->name('otro.tablaarticulo');
    Route::get('otro/tablaarticuloconnum/{idnumero}','Otro\ArticuloController@showconnumero')->name('otro.tablaarticuloconnum');
    Route::get('otro/tablanumero/{idrevista}','Otro\NumeroController@show')->name('otro.tablanumero');
    Route::get('otro/tablanumeroall','Otro\NumeroController@showall')->name('otro.tablanumeroall');
    Route::get('otro/tablarevista/{id}','Otro\RevistaController@show')->name('otro.tablarevista');
    Route::get('/otro_menuselecnumero/{idrevista}', 'Otro\MenuselecNumeroController@index')->name('otro.menuselecnumero');

    Route::get('/otro_menuseleccontr/{idrevista}', 'Otro\MenuSeleccionController@menuseleccontr')->name('otro.menuseleccontr');
    Route::get('otro/tablacontribuidor/{idarticulo}', 'Otro\ContribuidorController@show')->name('otro.tablacontribuidor');
    Route::get('/otro/contribuidor/create/{idarticulo}','Otro\ContribuidorController@create')->name('otro.contribuidor_create');
    Route::post('/otro/contribuidor/store/{idarticulo}','Otro\ContribuidorController@store')->name('otro.contribuidor_store');
    Route::get('otro/tablacontrcnum/{idnumero}', 'Otro\ContribuidorController@showconnum')->name('otro.tablacontrcnum');
    Route::get('/otro/contribuidor/createconnum/{idnumero}','Otro\ContribuidorController@createconnumero')->name('otro.contribuidor_createconnum');
    Route::post('/otro/contribuidor/storeconnum/{idnumero}','Otro\ContribuidorController@storeconnum')->name('otro.contribuidor_storeconnum');
    Route::get('/otro/contribuidorartcnum/create/{idarticulo}','Otro\ContribuidorController@createartcnum')->name('otro.contribuidorartcnum_create');
    Route::post('/otro/contribuidorartcnum/store/{idarticulo}','Otro\ContribuidorController@storeartcnum')->name('otro.contribuidorartcnum_store');

    Route::get('otro/tablacontrartcnum/{idarticulo}', 'Otro\ContribuidorController@showcontrnumart')->name('otro.tablacontrartcnum');


    Route::get('/otro_menuseleccontrnum/{idnumero}', 'Otro\MenuSeleccionController@menuseleccontrnum')->name('otro.menuseleccontrnum');
});

Route::middleware(['auth','role:otro'])->group(function(){
    //CREAR SOLICITUDES (boton terminar registro)

    Route::get('otro/solicitudRevista/{idrevista}','Otro\SolicitarController@solicitarRevista')->name('otro.solicitarRevista');
    Route::get('otro/solicitudArticuloR/{idarticulo}','Otro\SolicitarController@solicitarArticulodR')->name('otro.solicitarArticulodR');
    Route::get('otro/solicitarNumerodR/{idnumero}','Otro\SolicitarController@solicitarNumerodR')->name('otro.solicitarNumerodR');
    Route::get('otro/solicitarArticulodN/{idarticulo}','Otro\SolicitarController@solicitarArticulodN')->name('otro.solicitarArticulodN');


});
