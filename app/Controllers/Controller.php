<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Controller extends BaseController
{

    use ResponseTrait;

    public $respuesta = ["data" => [], "mensaje" => [], "error" => 1];

    public function respuestaNoError()
    {
        $this->respuesta["error"] = 0;
    }

    //registra un nuevo mensaje de error.
    public function agregarError($mensaje)
    {
        $this->respuesta["mensaje"][] = $mensaje;
    }

    //verifica si hay mensajes de error
    public function existeError()
    {
        if (empty($this->respuesta["mensaje"])) {
            return false;
        } else {
            return true;
        }
    }

    public function enviarRespuesta($codeHttp = 200)
    {
        return $this->respond($this->respuesta, (int) $codeHttp);
    }
}
