<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class contribuidor extends Model
{
    use HasFactory;

    protected $table = 'contribuidors';

    protected $fillable = [
        'apellido',
    ];

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'orcid' => ['nullable', 'regex:/^orcid.org\/\d{4}-\d{4}-\d{4}-\d{3}[0-9X]$/i'],

        ],[
            'orcid.regex'=>'El ORCID id debe tener el formato orcid.org/0000-0002-3621-1809 para ser valido.',

        ]);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function numero()
    {
        return $this->belongsTo(Numero::class);
    }
}
