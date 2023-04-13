<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Numero extends Model
{
    use HasFactory;

    protected $table = 'numeros';

    protected $fillable = [
        'numero',
    ];

//numero ia
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'numero' => ['required', 'string', 'min:3', 'max:255'],//
            'titulo' => ['nullable','string','min:4','max:255',],
            'doi' => ['nullable','string','min:4','max:255'],
            'url' => ['nullable','string','min:4','max:255'],
            'fechaimpr' => ['required_without:fechadig|date_format:d-m-Y'],
            'fechadig'=>['required_without:fechaimpr|date_format:d-m-Y'],
            'numespecial'=>['nullable','integer'],
            'volumen' => ['nullable','string'],
            'volumendoi' => ['nullable','integer'],
            'volumenurl'=>['nullable','string','max:255',],
        ],[
            'numero.required'=>'El número se encuentra vacío',
            'fechaimpr.required_without'=>'Se requiere la fecha de publicación impresa si no ha ingresado la fecha de publicación digital',
            'fechadig'=>'Se requiere la fecha de publicación impresa si no ha ingresado la fecha de publicación digital',
        ]);
    }

    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

    public function contribuidores(){
        return $this->hasMany(contribuidor::class);
    }
}
