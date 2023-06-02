<?php

namespace App\Http\Controllers\Revisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Models\Solicitud;
use App\Models\Revista;
use App\Models\Articulo;
use App\Models\Contribuidor;
use App\Models\Numero;
use Illuminate\Support\Facades\DB;

class RevisionController extends Controller
{
    //
    protected $table = 'solicituds';

    public function show(){
        $useract = auth()->user()->id;

        $estatus = 'asignada';
        // where estatus asignada y este asignada al usuario actual
        $solicituds = Solicitud::where([
        ['solicituds.estatus', '=', $estatus],
        ['solicituds.idrevisor', '=', $useract]
        ])
        ->leftJoin('articulos', 'solicituds.idarticulo','=','articulos.id')
        ->leftJoin('numeros','solicituds.idnumero','=','numeros.id')
        ->leftJoin('revistas','solicituds.idrevista','=','revistas.id')
        ->leftJoin('users','solicituds.idusuario','=','users.id')
        ->select('solicituds.id',
            DB::raw('CASE
                    WHEN solicituds.idnumero IS NOT NULL THEN numeros.titulo
                    WHEN solicituds.idarticulo IS NOT NULL THEN articulos.titulo
                    ELSE revistas.titulo
                    END AS nombre_solicitud'),
                    'users.name',
                    'solicituds.estatus',
        )
        ->get();

        return view('revisor.tsolicitudes',['solicituds'=>$solicituds]);
    }

    //MUESTRA LA VISTA SEGUN SEA EL CASO DE SOLICITUD
    public function showsolicitud($id){
        $solicitud = Solicitud::find($id);

        //PARA REVISTA
        if(!empty($solicitud->idrevista)){

            $idrevista = Solicitud::where('id',$id)->value('idrevista');

            $revistas = Revista::where('id',$idrevista)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('revisor.trevista',['revistas'=>$revistas, 'solicituds'=>$solicituds]);

        }elseif($solicitud->idarticulo){
            //PARA ARTICULO

            $idarticulo = Solicitud::where('id',$id)->value('idarticulo');

            $articulos = Articulo::where('id',$idarticulo)->get();

            $contribuidores = Contribuidor::where('idarticulo',$idarticulo)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('revisor.tarticulo',compact('articulos','contribuidores','solicituds'));

        }elseif($solicitud->idnumero){

            //PARA NUMERO
            $idnumero = Solicitud::where('id',$id)->value('idnumero');

            $numeros = Numero::where('id',$idnumero)->get();

            $contribuidores = Contribuidor::where('idnumero',$idnumero)->get();

            $solicituds = Solicitud::where('id',$id)->get();

            return view('revisor.tnumero',compact('numeros','contribuidores','solicituds'));
        }
    }

    //GUARDA LA OBSERVACION DE UN ARTICULO
    public function guardar(Request $request, $idarticulo){
         $solicitud = Solicitud::where('idarticulo',$idarticulo)->first();
         $solicitud->observaciones = $request->input('observaciones');
         $solicitud->estatus = "corregir";
         $solicitud->save();

         return redirect()->route('revisor.tsolicitudes');
    }

    //GUARDA LA OBSERVACION DE UNA REVISTA
    public function guardarRevista(Request $request, $idrevista){
         $solicitud = Solicitud::where('idrevista',$idrevista)->first();
         $solicitud->observaciones = $request->input('observaciones');
         $solicitud->estatus = "corregir";
         $solicitud->save();

         return redirect()->route('revisor.tsolicitudes');
    }

    //GUARDA LA OBSERVACION DE UN NUMERO
    public function guardarNumero(Request $request, $idnumero){
         $solicitud = Solicitud::where('idnumero',$idnumero)->first();
         $solicitud->observaciones = $request->input('observaciones');
         $solicitud->estatus = "corregir";
         $solicitud->save();

         return redirect()->route('revisor.tsolicitudes');
    }

    //SI NO SE TIENEN CORRECCIONES QUE REALIZAR SE CAMBIA EL ESTATUS A APROBADO Y REGRESA A LA TABLA DE SOLICITUDES
    public function aprobarRevista($idrevista){
        $solicitud = Solicitud::where('idrevista',$idrevista)->first();
        $solicitud->estatus = "aprobado";
        $solicitud->save();
        return redirect()->route('revisor.tsolicitudes');
    }

    public function aprobarArticulo($idarticulo){
        $solicitud = Solicitud::where('idarticulo',$idarticulo)->first();
        $solicitud->estatus = "aprobado";
        $solicitud->save();
        return redirect()->route('revisor.tsolicitudes');
    }

    public function aprobarNumero($idnumero){
        $solicitud = Solicitud::where('idnumero',$idnumero)->first();
        $solicitud->estatus = "aprobado";
        $solicitud->save();
        return redirect()->route('revisor.tsolicitudes');
    }

}
