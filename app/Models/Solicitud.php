<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Solicitud extends Model
{
    use HasFactory;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'idusuario' => ['nullable', 'unsignedBigInteger',],
            'idrevista' => ['nullable', 'unsignedBigInteger'],
            'estatus' => ['string', 'min:3', 'max:255'],
            'doicreado' => ['nullable','string','max:255',],

        ]);

    }

    protected $fillable = [
        'estatus'=>'inicio',

    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }

}
