<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    $params = explode(",",$argv[1]);
    $claseVehiculo=$params[0];
    $tipoServicio=$params[1];
    
    switch($claseVehiculo){
        case 1:
            $mercadoObjetivo = 1;
            break;
        case 2:
            $mercadoObjetivo = 1;
            break;
        case 3:
            $mercadoObjetivo = 1;
            break;
        case 4:
            $mercadoObjetivo = 2;
            break;
        case 5:
            $mercadoObjetivo = 2;
            break;
        case 6:
            $mercadoObjetivo = 2;
            break;
        case 7:
            $mercadoObjetivo = 3;
            break;
        case 8:
            $mercadoObjetivo = 3;
            break;
        case 9:
            $mercadoObjetivo = 3;
            break;
        case 10:
            $mercadoObjetivo = 4;
            break;
        case 11:
            $mercadoObjetivo = 4;
            break;
        case 12:
            $mercadoObjetivo = 4;
            break;
        default:
            $mercadoObjetivo = 0;
            break;
    }

    //Query de insercion de registro
    $query="SELECT A.NOMBRE_COMERCIAL, B.NOMBRE AS CIUDAD, C.ESTABLECIMIENTO_COMERCIO AS ID_ESTABLECIMIENTO  FROM AC_ESTABLECIMIENTO_COMERCIO A, AC_P_CIUDAD B, AC_MERCADO_OFERENTE C, AC_TIPO_PROVEEDOR D WHERE A.ID = C.ESTABLECIMIENTO_COMERCIO AND A.CIUDAD = B.CODIGO AND C.MERCADO_OBJETIVO=$mercadoObjetivo AND A.ID = D.ESTABLECIMIENTO_COMERCIO AND D.SERVICIO=$tipoServicio";

    $resultado= oci_parse($conn, $query);
    oci_execute($resultado);
    $cerrar=oci_close($conn);
    while($row = oci_fetch_assoc($resultado))
    {
        $rows[] = $row;
    }
    $datos = array('status' => true, 'datos' => $rows);
    echo json_encode($datos);
}
else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}
?>
