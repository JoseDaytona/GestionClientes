<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $fillable = [
        'nombre',
        'documento_identidad',
    ];
    protected $attributes = [
        'nombre' => '',
        'documento_identidad' => '',
    ];
}
