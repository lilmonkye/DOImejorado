<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idrevista',
        'titulo',
        'url',
        'fechaimpr',
        'fechadig',
        'banddoi',
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
            'idrevista' => ['required', 'unsignedBigInteger',],
            'titulo' => ['required', 'string', 'min:8','max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','string','max:255'],
            'fechaimpr' => ['required|date_format:Y-m-d'],
            'fechadig' => ['required|date_format:Y-m-d'],
            'primerpag' => ['required','integer'],
            'ultimapag' => ['required','integer'],
            'abstract'=>['nullable','string','max:255',],
            'bandoi'=>['required','nullable','boolean'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Articulo
     */
    protected function create(array $data)
    {
        $articuloFields = [
            'titulo' => $data['titulo'],
            'tituloabr' => $data['tituloabr'],
            'doi' => $data['doi'],
            'url' => $data['url'],
            'issnimp' => $data['issnimp'],
            'issnelec' => $data['issnelec'],
            'idioma' => $data['idioma'],
            'bandoi' => $data['bandoi'],
        ];


        $articulo = Articulo::create($articuloFields);

        return $articulo;
    }

    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }
}
