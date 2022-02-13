<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Venta;

class MasterController extends Controller
{
    public function index()
    {
        $productoModel = new Producto();
        $ventaModel = new Venta();

        $cantidadProductos = $productoModel->countAll();
        $cantidadVentas = $ventaModel->countAll();

        $productos = $productoModel->orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $ventas = $ventaModel->select('ventas.*, p.nombre')
            ->join('productos p', 'ventas.producto_id = p.id')
            ->limit(5)
            ->orderBy('id', 'desc')
            ->get()
            ->getResultArray();

        return view('platform/dashboard', compact('cantidadProductos', 'cantidadVentas', 'productos', 'ventas'));
    }
}
