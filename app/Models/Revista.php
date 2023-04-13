<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Revista extends Model
{
    use HasFactory;

    protected $table = 'revistas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'url',
        'issnelec',
        'bandoi',
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'idusuario' => ['nullable', 'unsignedBigInteger',],
            'titulo' => ['required', 'string', 'min:4','max:255'],
            'tituloabr' => ['nullable', 'string', 'min:2', 'max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','string','max:255'],
            'issnimp' => ['required_without:issnelec'],
            'issnelec' => ['required_without:issnimp'],
            'idioma'=>['nullable','string','max:255',],
        ],[
            'titulo.required'=>'El título se encuentra vacío.',
            'url.required'=>'El url se encuentra vacío',
            'issnimp.required_without'=>'Se requiere el Issn impreso si no ha ingresado el Issn digital',
            'issnelec.required_without'=>'Se requiere el Issn digital si no ha ingresado el Issn impreso',


        ]);
    }


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
