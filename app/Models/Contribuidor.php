<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contribuidor extends Model
{
    use HasFactory;

    protected $table = 'contribuidors';

    protected $fillable = [
        'apellido',
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function numero()
    {
        return $this->belongsTo(Numero::class);
    }
}
