<?php

namespace App\Models;

use App\Casts\CleanHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



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
    protected $casts =   [
        'titulo'    =>  CleanHTML::class,
        'doi'       =>  CleanHTML::class,
        'url'       =>  CleanHTML::class,
        'fechaimpr' =>  CleanHTML::class,
        'fechadig'  =>  CleanHTML::class,
        'primerpag' =>  CleanHTML::class,
        'ultimapag' =>  CleanHTML::class,
        'abstract'  =>  CleanHTML::class,
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
            'abstract'=>['nullable'],
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

    public function numero()
    {
        return $this->belongsTo(Numero::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }
}
