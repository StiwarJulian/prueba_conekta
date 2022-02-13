<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Producto extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields    = [
        'nombre', 'referencia', 'precio', 'peso', 'categoria', 'stock', 'fecha_creacion'
    ];

    protected $useTimestamps = false;
}
