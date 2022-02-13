<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Producto;
use App\Models\Venta;
use Exception;

class VentaController extends Controller
{

    private $productoModel;
    private $ventaModel;

    public function __construct()
    {
        $this->productoModel = new Producto();
        $this->ventaModel = new Venta();
    }

    public function index()
    {
        $ventas = $this->ventaModel->select('ventas.*, p.nombre')
            ->join('productos p', 'ventas.producto_id = p.id')
            ->orderBy('id', 'desc')
            ->get()
            ->getResultArray();

        return view('platform/pages/ventas/index', compact('ventas'));
    }

    public function crear()
    {
        return view('platform/pages/ventas/crear');
    }

    public function guardar()
    {
        try {
            $validation =  \Config\Services::validation();

            $validation->setRules([
                'producto'   => ['required'],
                'cantidad'   => ['required']
            ]);

            $validation->run($this->request->getJSON(true));

            if ($validation->getErrors()) {
                foreach ($validation->getErrors() as $value) {
                    $this->agregarError($value);
                }
            }

            if (!$this->existeError()) {
                $datos = $this->request->getJSON(true);

                $producto = $this->productoModel->where('id', $datos['producto'])->first();

                if (empty($producto)) {
                    $this->agregarError('El producto no se encontro');
                } else if ($datos['cantidad'] > $producto['stock']) {
                    $this->agregarError('La cantidad ingresada es superior a la cantidad disponible');
                }

                if (!$this->existeError()) {
                    $infoVenta = array(
                        'producto_id' => $datos["producto"],
                        'cantidad' => $datos["cantidad"],
                        'total' => $producto['precio'] * $datos['cantidad'],
                        'fecha_venta' => date("Y-m-d")
                    );

                    $respuesta = $this->ventaModel->insert($infoVenta);

                    if ($respuesta) {

                        $producto['stock'] = $producto['stock'] - $datos['cantidad'];
                        $this->productoModel->update($producto['id'], $producto);

                        $this->respuestaNoError();
                    }
                }
            }
        } catch (Exception $ex) {
            $this->agregarError('Ha ocurrido un error en el proceso, vuelve a intentarlo');
            log_message("debug", $ex->getFile() . " - " . $ex->getLine() . " - " . $ex->getMessage());
        }

        return $this->enviarRespuesta();
    }
}
