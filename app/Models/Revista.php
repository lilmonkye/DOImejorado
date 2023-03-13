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
            'idsolicitud' => ['required', 'unsignedBigInteger',],
            'titulo' => ['required', 'string', 'min:8','max:255'],
            'tituloabr' => ['required', 'string', 'min:3', 'max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','string','max:255'],
            'issnimp' => ['required','integer'],
            'issnelec' => ['required','integer'],
            'idioma'=>['nullable','string','max:255',],
            'bandoi'=>['required','nullable','boolean'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Revista
     */
    protected function create(array $data)
    {
        $revistaFields = [
            'titulo' => $data['titulo'],
            'tituloabr' => $data['tituloabr'],
            'doi' => $data['doi'],
            'url' => $data['url'],
            'issnimp' => $data['issnimp'],
            'issnelec' => $data['issnelec'],
            'idioma' => $data['idioma'],
            'bandoi' => $data['bandoi'],
        ];


        $revista = Revista::create($revistaFields);

        return $revista;
    }
}
