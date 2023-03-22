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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'idusuario' => ['nullable', 'unsignedBigInteger',],
            'titulo' => ['required', 'string', 'min:8','max:255'],
            'tituloabr' => ['required', 'string', 'min:3', 'max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','string','max:255'],
            'issnimp' => ['required_without:issnelec','integer'],
            'issnelec' => ['required_without:issnimp','integer'],
            'idioma'=>['nullable','string','max:255',],
            'bandoi'=>['required','nullable','boolean'],
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
