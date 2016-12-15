<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    //Query de insercion de registro
    $query="SELECT CODIGO, NOMBRE FROM AC_P_DEPARTAMENTO";

    $resultado= oci_parse($conn, $query);
    oci_execute($resultado);
    $cerrar=oci_close($conn);
    $resultado = oci_fetch_array($resultado, OCI_ASSOC);
    echo json_encode($resultado);
}
else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}
?>
