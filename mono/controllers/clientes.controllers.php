<?php
error_reporting(0);
require_once('../config/sesiones.php');
require_once("../models/clientes.models.php");

$Clientes = new Clientes;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $Clientes->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idCliente = $_POST["idCliente"];
        $datos = array();
        $datos = $Clientes->uno($idCliente);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    
    case 'insertar':
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo_electronico = $_POST["correo_electronico"];
        $datos = array();
        $datos = $Clientes->Insertar($nombres, $apellidos, $telefono, $correo_electronico);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $idCliente = $_POST["id"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo_electronico = $_POST["correo_electronico"];
        $datos = array();
        $datos = $Clientes->Actualizar($idCliente, $nombres, $apellidos, $telefono, $correo_electronico);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idCliente = $_POST["idCliente"];
        $datos = array();
        $datos = $Clientes->Eliminar($idCliente);
        echo json_encode($datos);
        break;
}
