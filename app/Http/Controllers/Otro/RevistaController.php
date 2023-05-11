<?php

namespace App\Http\Controllers\Otro;
use App\Http\Controllers\Controller;
use App\Models\Revista;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class RevistaController extends Controller
{
    public function __construct() {
        $this->middleware('role:otro');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('otro.revistaform');
    }

    public function menuseleccion()
    {
        return view('otro.menuseleccion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('otro.revistaform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Revista::validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            $useract = Auth::user();
            $revista = new Revista();
            $revista->titulo = $request->input('titulo');
            $revista->tituloabr = $request->input('tituloabr');
            $revista->doi = $request->input('doi');
            $revista->url = $request->url;
            $revista->issnimp = $request->issnimp;
            $revista->issnelec = $request->issnelec;
            $revista->idioma = $request->idioma;
            $revista['idusuario'] = $useract->id;
            $datosRevista = request()->except('_token','bandoi');

            $revista->save();

            $msg = 'Revista guardada, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            return redirect()->route('otro.menuseleccion',['idrevista'=> $revista->id]);
        }
        /*
            si quiero mostrar en el mismo blade de registro el mensaje
            $notification = array(
            'msg' => 'Revista guardada, en espera de revisión',
            'alert-type' => 'success'
        ); */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $useract = Auth::user();
        $revistas = Revista::where('idusuario', $useract->id)->get();
        $url = route('otro.tablarevista', ['id' => $useract->id]);
        return view('otro.tablarevista',['revistas'=>$revistas,'url'=>$url]);
    }

    public function showregistro()
    {
        $useract = Auth::user();

        $revistas = Revista::where('idusuario',$useract->id)->get();

        return view('otro.trevistasedit',['revistas'=>$revistas]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $revista = Revista::findOrFail($id);
        return view ('otro.revistaformEdit',compact('revista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Obtener el artículo correspondiente al ID recibido en la ruta
        $revista = Revista::findOrFail($id);
        $validator = Revista::validator($request->all());


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            // Actualizar los atributos del modelo a partir de los valores recibidos del formulario
            $revista->titulo = $request->input('titulo');
            $revista->tituloabr = $request->input('tituloabr');
            $revista->url = $request->input('url');
            $revista->issnimp = $request->input('issnimp');
            $revista->issnelec = $request->input('issnelec');
            $revista->idioma = $request->input('idioma');

            // Guardar en la base de datos
            $revista->save();

            $msg = 'Articulo actualizado, en espera de revisión';
            $alertType = 'success';
            session()->flash('msg', $msg);
            session()->flash('alert-type', $alertType);

            // Redireccionar al usuario a la vista de detalles del artículo actualizado
            return redirect()->route('otro.trevistasedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function agregarArt()
    {
        $useract = Auth::user();

        $revista = Revista::where('idusuario',$useract->id)->get();
    }


}
