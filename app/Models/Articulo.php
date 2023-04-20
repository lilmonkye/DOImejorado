<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Casts\HtmlPurifier;
use Mews\Purifier\Casts\CleanHtml;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $primaryKey = 'id';

    //CAMPOS OBLIGATORIOS DEL FORMULARIO
    protected $fillable = [
        'idrevista',
        'titulo',
        'url',
        'fechaimpr',
        'fechadig',
    ];

    //SEGURIDAD ANTISCRIPTS
    protected $cast =   [
        'titulo'    =>  HTMLPurifier::class,
        'doi'       =>  HTMLPurifier::class,
        'url'       =>  HTMLPurifier::class,
        'fechaimpr' =>  HTMLPurifier::class,
        'fechadig'  =>  HTMLPurifier::class,
        'primerpag' =>  HTMLPurifier::class,
        'ultimapag' =>  HTMLPurifier::class,
        'abstract'  =>  HTMLPurifier::class,
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     //VALIDACION DE CAMPOS DEL FORMULARIO Y MENSAJES DE ERROR
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'min:8','max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','active_url','max:255'],
            'fechaimpr' => ['required_without:fechadig'],
            'fechadig' => ['required_without:fechaimpr'],
            'primerpag' => ['nullable','integer'],
            'ultimapag' => ['nullable','integer'],
            'abstract'=>['nullable','text'],
        ],[
            'titulo.required'=>'El título se encuentra vacío',
            'url.required'=>'El url se encuentra vacío.',
            'url.active_url'=>'El url no es válido',
            'fechaimpr.required_without'=>'Se requiere la fecha de publicación impresa si no ha ingresado fecha de publicación digital',
            'fechadig.required_without'=>'Se requiere la fecha de publicación digital si no ha ingresado fecha de publicación impresa',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Articulo
     */

    //RELACIONES
    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }
}
