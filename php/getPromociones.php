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
    $query="SELECT A.NOMBRE, A.DESCRIPCION, A.URL_IMAGEN, B.NOMBRE AS CIUDAD FROM AC_OFERTAS A, AC_P_CIUDAD B, AC_ESTABLECIMIENTO_COMERCIO C WHERE A.ID_ESTABLECIMIENTO=C.ID AND C.CIUDAD=B.CODIGO AND A.MERCADO_OBJETIV=$mercadoObjetivo AND A.SERVICIO=$tipoServicio";
//pruebas
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
