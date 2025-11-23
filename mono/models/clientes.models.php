<?php
require_once('../config/conexion.php');

class Clientes
{
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `clientes` ORDER BY id DESC";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    
    public function uno($idCliente)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `clientes` WHERE id = $idCliente";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
   
    public function Insertar($nombres, $apellidos, $telefono, $correo_electronico)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT into clientes(nombres, apellidos, telefono, correo_electronico, fecha_creacion) 
        values ('$nombres', '$apellidos', '$telefono', '$correo_electronico', NOW())";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos: ' . mysqli_error($con);
        }
        $con->close();
    }
   
    public function Actualizar($idCliente, $nombres, $apellidos, $telefono, $correo_electronico)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE clientes SET 
                   nombres='$nombres', 
                   apellidos='$apellidos', 
                   telefono='$telefono', 
                   correo_electronico='$correo_electronico' 
                   WHERE id = $idCliente";
      
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'error al actualizar el registro: ' . mysqli_error($con);
        }
        $con->close();
    }
    
    public function Eliminar($idCliente)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM `clientes` WHERE id = $idCliente";
      
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
