<?php
require_once 'config/Config.php';
spl_autoload_register(function($nombre_class){
    include 'modelo/'.$nombre_class.'.class.php';
});

$method = $_SERVER['REQUEST_METHOD'];
$jsonData = array();
$mensaje= "No se ha procesado la peticion";
$estado = 2;
$codePeticion = 200;

$estudiante = new Evento();

switch($method) {
    case 'GET':
        $id = isset($_GET["id"])?$_GET["id"]:0;

        if($id > 0 && !empty($id)){
            $data = $estudiante->getEvento($id);
        } else {
            $data = $estudiante->allEventos();
        }

        $estado = isset($estudiante->estado) ? $estudiante->estado : $estado;
        $mensaje = isset($estudiante->mensaje) ? $estudiante->mensaje : $mensaje;
        $jsonData["rows"] = $data;
    break;
    case 'POST':
    break;
    case 'PUT':
    break;
    case 'DELETE':
    break;
    default:
    break;
}

$jsonData["mensaje"] =$mensaje;
$jsonData["estado"] =$estado;

header("Content-Type: application/json");
http_response_code($codePeticion);
echo json_encode($jsonData);
?>