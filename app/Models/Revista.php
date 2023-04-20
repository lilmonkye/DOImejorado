<?php

namespace App\Models;

use App\Casts\CleanHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Casts\StripTags;


class Revista extends Model
{
    use HasFactory;

    protected $table = 'revistas';

    protected $primaryKey = 'id';

    //Campos que no deben estar vacios

    protected $fillable = [
        'titulo',
        'url',

    ];

    //Seguridad (quita tags de campos del formulario). No es necesario llamarlas

    protected $casts = [
        'titulo'    =>  CleanHtml::class,
        'tituloabr' =>  CleanHtml::class,
        'doi'       =>  CleanHtml::class,
        'url'       =>  CleanHtml::class,
        'issnimp'   =>  CleanHtml::class,
        'issnelec'  =>  CleanHtml::class,
        'idioma'    =>  CleanHtml::class,
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //Validaciones y mensajes de fallo
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'idusuario' => ['nullable', 'unsignedBigInteger',],
            'titulo' => ['required', 'string', 'min:4','max:255'],
            'tituloabr' => ['nullable', 'string', 'min:2', 'max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','max:255','active_url'],
            'issnimp' => ['nullable','required_without_all:issnelec','regex:/^\d{4}-\d{4}$/'],
            'issnelec' => ['nullable','required_without_all:issnimp','regex:/^\d{4}-\d{4}$/'],
            'idioma'=>['nullable','string','max:255',],
        ],[
            'titulo.required'=>'El título se encuentra vacío.',
            'url.required'=>'El url se encuentra vacío.',
            'url.active_url'=>'El dado url no es válido.',
            'issnimp.regex'=>'Formato de Issn impreso no válido.',
            'issnelec.regex'=>'Formato de Issn electrónico no válido.',
            'issnimp.required_without_all' => 'Por favor, ingrese al menos un ISSN.',
            'issnelec.required_without_all' => 'Por favor, ingrese al menos un ISSN.',

        ]);
    }


    //Relaciones con otros modelos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articulos(){
        return $this->hasMany(Articulo::class);
    }

    public function numeros(){
        return $this->hasMany(Numero::class);
    }

    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }


}
