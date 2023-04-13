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
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'min:8','max:255'],
            'doi' => ['nullable','string','max:255',],
            'url' => ['required','string','max:255'],
            'fechaimpr' => ['required_without:fechadig|date_format:d-m-Y'],
            'fechadig' => ['required_without:fechaimpr|date_format:d-m-Y'],
            'primerpag' => ['nullable','integer'],
            'ultimapag' => ['nullable','integer'],
            'abstract'=>['nullable','string','max:255',],
        ],[
            'titulo.required'=>'El título se encuentra vacío',
            'url.required'=>'El url se encuentra vacío.',
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

    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }
}
