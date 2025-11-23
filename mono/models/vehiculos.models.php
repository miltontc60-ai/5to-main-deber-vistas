<?php
require_once('../config/conexion.php');

class Vehiculos
{
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT v.*, 
                   CONCAT(c.nombres, ' ', c.apellidos) as nombre_cliente,
                   c.nombres as cliente_nombres,
                   c.apellidos as cliente_apellidos
                   FROM vehiculos v 
                   INNER JOIN clientes c ON v.id_cliente = c.id 
                   ORDER BY v.id DESC";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    
    public function uno($idVehiculo)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `vehiculos` WHERE id = $idVehiculo";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
   
    public function Insertar($id_cliente, $marca, $modelo, $anio, $tipo_motor)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT into vehiculos(id_cliente, marca, modelo, anio, tipo_motor, fecha_creacion) 
        values ($id_cliente, '$marca', '$modelo', $anio, '$tipo_motor', NOW())";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos: ' . mysqli_error($con);
        }
        $con->close();
    }
   
    public function Actualizar($idVehiculo, $id_cliente, $marca, $modelo, $anio, $tipo_motor)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE vehiculos SET 
                   id_cliente=$id_cliente, 
                   marca='$marca', 
                   modelo='$modelo', 
                   anio=$anio,
                   tipo_motor='$tipo_motor' 
                   WHERE id = $idVehiculo";
      
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'error al actualizar el registro: ' . mysqli_error($con);
        }
        $con->close();
    }
    
    public function Eliminar($idVehiculo)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM `vehiculos` WHERE id = $idVehiculo";
      
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
