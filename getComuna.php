<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    $params = explode(",",$argv[1]);
    $barrio=$params[0];
    //Query de insercion de registro
    $query="SELECT C.NOMBRE_COMUNA FROM AC_P_COMUNA C, AC_P_BARRIO B WHERE C.CODIGO=B.CODIGO_COMUNA AND B.CODIGO=$barrio";

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
