<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesVenta extends Model
{
    protected $table = 'detalle_ventas_';
    protected $fillable = [
        'idVenta',
        'idProducto',
        'cantidad',
        'precio'
    ];
}
