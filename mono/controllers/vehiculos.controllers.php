<?php
error_reporting(0);
require_once('../config/sesiones.php');
require_once("../models/vehiculos.models.php");

$Vehiculos = new Vehiculos;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $Vehiculos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $idVehiculo = $_POST["idVehiculo"];
        $datos = array();
        $datos = $Vehiculos->uno($idVehiculo);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    
    case 'insertar':
        $id_cliente = $_POST["id_cliente"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $anio = $_POST["anio"];
        $tipo_motor = $_POST["tipo_motor"];
        $datos = array();
        $datos = $Vehiculos->Insertar($id_cliente, $marca, $modelo, $anio, $tipo_motor);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $idVehiculo = $_POST["id"];
        $id_cliente = $_POST["id_cliente"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $anio = $_POST["anio"];
        $tipo_motor = $_POST["tipo_motor"];
        $datos = array();
        $datos = $Vehiculos->Actualizar($idVehiculo, $id_cliente, $marca, $modelo, $anio, $tipo_motor);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $idVehiculo = $_POST["idVehiculo"];
        $datos = array();
        $datos = $Vehiculos->Eliminar($idVehiculo);
        echo json_encode($datos);
        break;
}
