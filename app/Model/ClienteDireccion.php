<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClienteDireccion extends Model
{
    protected $table = 'cliente_direccion';
    protected $fillable = [
        'id_cliente',
        'direccion',
    ];
    protected $attributes = [
        'id_cliente' => 0,
        'direccion' => '',
    ];
}
