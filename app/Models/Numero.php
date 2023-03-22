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
            'idrevista' => ['required', 'unsignedBigInteger',],//
            'idarticulo' => ['required', 'unsignedBigInteger'],//
            'numero' => ['required', 'string', 'min:3', 'max:255'],//
            'titulo' => ['nullable','string','min:4','max:255',],
            'doi' => ['nullable','string','min:4','max:255'],
            'url' => ['nullable','string','min:4','max:255'],
            'fechaimpr' => ['required_without:fechadig','date'],
            'fechadig'=>['required_without:fechaimpr','date'],
            'numespecial'=>['nullable','integer'],
            'volumen' => ['nullable','string'],
            'volumendoi' => ['nullable','integer'],
            'volumenurl'=>['nullable','string','max:255',],
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
