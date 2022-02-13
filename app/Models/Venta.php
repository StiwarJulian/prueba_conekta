<?php

namespace App\Models;

use CodeIgniter\Model;

class Venta extends Model
{
    protected $table            = 'ventas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'producto_id', 'cantidad', 'total', 'fecha_venta'
    ];

    // Dates
    protected $useTimestamps = false;
}
