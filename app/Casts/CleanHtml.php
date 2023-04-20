<?php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use HTMLPurifier;

class CleanHtml implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        return (new HTMLPurifier())->purify($value);
    }
}



