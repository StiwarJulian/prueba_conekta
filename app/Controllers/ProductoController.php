<?php

namespace App\Controllers;

use App\Models\Producto;
use CodeIgniter\HTTP\IncomingRequest;
use Exception;

class ProductoController extends Controller
{
    private $productoModel;

    public function __construct()
    {
        $this->productoModel = new Producto();
    }

    public function index()
    {
        $productos = $this->productoModel
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return view('platform/pages/producto/index', compact('productos'));
    }

    public function crear()
    {
        return view('platform/pages/producto/crear');
    }

    public function guardar()
    {
        try {
            $validation =  \Config\Services::validation();

            $validation->setRules([
                'nombre'        => ['required'],
                'referencia'    => ['required'],
                'categoria'     => ['required'],
                'precio'        => ['required', 'integer'],
                'peso'          => ['required', 'integer'],
                'cantidad'      => ['required', 'integer'],
            ]);

            $validation->run($this->request->getJSON(true));

            if ($validation->getErrors()) {
                foreach ($validation->getErrors() as $value) {
                    $this->agregarError($value);
                }
            }

            if (!$this->existeError()) {
                $datos = $this->request->getJSON(true);

                $infoProducto = array(
                    'nombre' => $datos["nombre"],
                    'referencia' => $datos["referencia"],
                    'precio' => $datos["precio"],
                    'peso' => $datos["peso"],
                    'categoria' => $datos["categoria"],
                    'stock' => $datos['cantidad'],
                    'fecha_creacion' => date("Y-m-d")
                );

                $respuesta = $this->productoModel->insert($infoProducto);

                if ($respuesta) {
                    $this->respuestaNoError();
                }
            }
        } catch (Exception $ex) {
            $this->agregarError('Ha ocurrido un error en el proceso, vuelve a intentarlo');
            log_message("debug", $ex->getFile() . " - " . $ex->getLine() . " - " . $ex->getMessage());
        }

        return $this->enviarRespuesta();
    }

    public function editar($id)
    {
        $producto = $this->productoModel->where('id', $id)->first();

        return view('platform/pages/producto/editar', compact('producto'));
    }

    public function actualizar()
    {
        try {
            $validation =  \Config\Services::validation();

            $validation->setRules([
                'nombre'        => ['required'],
                'referencia'    => ['required'],
                'categoria'     => ['required'],
                'precio'        => ['required', 'integer'],
                'peso'          => ['required', 'integer'],
                'cantidad'      => ['required', 'integer'],
            ]);

            $validation->run($this->request->getJSON(true));

            if ($validation->getErrors()) {
                foreach ($validation->getErrors() as $value) {
                    $this->agregarError($value);
                }
            }

            if (!$this->existeError()) {
                $datos = $this->request->getJSON(true);

                $infoProducto = array(
                    'nombre' => $datos["nombre"],
                    'referencia' => $datos["referencia"],
                    'precio' => $datos["precio"],
                    'peso' => $datos["peso"],
                    'categoria' => $datos["categoria"],
                    'stock' => $datos['cantidad'],
                    'fecha_creacion' => date("Y-m-d")
                );

                $respuesta = $this->productoModel->update($datos['id'], $infoProducto);

                if ($respuesta) {
                    $this->respuestaNoError();
                }
            }
        } catch (Exception $ex) {
            $this->agregarError('Ha ocurrido un error en el proceso, vuelve a intentarlo');
            log_message("debug", $ex->getFile() . " - " . $ex->getLine() . " - " . $ex->getMessage());
        }

        return $this->enviarRespuesta();
    }

    public function listado()
    {
        $this->respuesta['data'] = $this->productoModel->where('stock > 0')->get()->getResultArray();
        $this->respuestaNoError();
        return $this->enviarRespuesta();
    }

    public function consultar($id)
    {
        $this->respuesta['data'] = $this->productoModel->where('id', $id)->first();
        $this->respuestaNoError();
        return $this->enviarRespuesta();
    }
}
