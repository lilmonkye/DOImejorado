<?php

namespace App\Models;

use App\Casts\CleanHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class contribuidor extends Model
{
    use HasFactory;

    protected $table = 'contribuidors';

    protected $primarykey = 'id';

    //CAMPOS OBLIGATORIOS
    protected $fillable = [
        'apellido',
    ];

    //LIMPIEZA DE DATOS DEL FORMULARIO
    protected $casts = [
        'nombre'            =>  CleanHtml::class,
        'apellido'          =>  CleanHtml::class,
        'afiliacion'        =>  CleanHtml::class,
        'orcid'             =>  CleanHtml::class,
        'nomalternativo'    =>  CleanHtml::class,
        'rol'               =>  CleanHtml::class,
    ];

    //VALIDACIONES Y MENSAJES DE ERROR
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'nombre'        =>  ['nullable','string','min:2', 'max:102'],
            'apellido'      =>  ['string','min:2','max:102'],
            'afiliacion'    =>  ['nullable','string','min:2','max:255'],
            'orcid'         =>  ['nullable','regex:/^orcid.org\/\d{4}-\d{4}-\d{4}-\d{3}[0-9X]$/i'],
            'nomalternativo'=>  ['nullable','string','min:2','max:80'],
            'rol'           =>  ['nullable','string','min:5','max:25'],

        ],[
            'apellido'      =>  'El apellido se encuentra vacío.',
            'orcid.regex'   =>  'El ORCID id debe tener el formato orcid.org/0000-0002-3621-1809 para ser valido.',

        ]);
    }

    //RELACIONES
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function numero()
    {
        return $this->belongsTo(Numero::class);
    }
}
