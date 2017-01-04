<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){+
    $params = explode(",",$argv[1]);
    $placa=$params[0];
    $disponible=0;
    //Query de insercion de registro
    $query="SELECT PLACA FROM AC_VEHICULO WHERE PLACA = '${placa}'";
    $resultado= oci_parse($conn, $query);
    oci_execute($resultado);
    $cerrar=oci_close($conn);
    $row = oci_fetch_array($resultado, OCI_ASSOC);
    if ($row['PLACA']==$placa ){
    $disponible = 1;
    }
    $datos = array('status' => $disponible);
    echo json_encode($datos);
}
else{
    $disponible=2;
    $res = array('status' => $disponible, 'message' => 'Connection error');
    echo json_encode($res);
}
?>