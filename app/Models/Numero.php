<?php

namespace App\Models;

use App\Casts\CleanHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Numero extends Model
{
    use HasFactory;

    protected $table = 'numeros';

    //CAMPOS OBLIGATORIOS UNA DE LAS FECHAS ES OBLIGATORIO PERO ESTO SE REALIZA EN LA VALIDACION
    protected $fillable = [
        'numero',
    ];

    //SEGURIDAD ANTI SCRIPTS
    protected $casts = [
        'numero'        =>  CleanHtml::class,
        'titulo'        =>  CleanHtml::class,
        'doi'           =>  CleanHtml::class,
        'url'           =>  CleanHtml::class,
        'fechaimpr'     =>  CleanHtml::class,
        'fechadig'      =>  CleanHtml::class,
        'numespecial'   =>  CleanHtml::class,
        'volumen'       =>  CleanHtml::class,
        'volumendoi'    =>  CleanHtml::class,
        'volumenurl'    =>  CleanHtml::class,
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     //VALIDACIÓN Y MENSAJES DE ERROR
    protected static function validator(array $data)
    {
        return Validator::make($data, [
            'numero' => ['required', 'integer', 'min:1', 'max:255'],//
            'titulo' => ['nullable','string','min:4','max:255',],
            'doi' => ['nullable','string','min:4','max:255'],
            'url' => ['nullable','active_url','min:4','max:255'],
            'fechaimpr' => ['nullable','required_without_all:fechadig'],
            'fechadig'=>['nullable','required_without_all:fechaimpr'],
            'numespecial'=>['nullable','string'],
            'volumen' => ['nullable','integer'],
            'volumendoi' => ['nullable','string'],
            'volumenurl'=>['nullable','active_url','max:255',],
        ],[
            'numero.required'=>'El número se encuentra vacío',
            'url.active_url'=>'El url no es válido',
            'fechaimpr.required_without_all'=>'Se requiere la fecha de publicación impresa si no ha ingresado la fecha de publicación digital',
            'fechadig.required_without_all'=>'Se requiere la fecha de publicación digital si no ha ingresado la fecha de publicación impresa',
            'volumenurl.active_url'=>'La url del volumen no es valida'
        ]);
    }

    //RELACIONES
    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }

    public function articulos(){
        return $this->hasMany(Articulo::class);
    }
}
