<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    //Query de insercion de registro
    $query="SELECT CODIGO, NOMBRE FROM AC_P_CLASE_VEHICULO";

    $resultado= oci_parse($conn, $query);
    oci_execute($resultado);
    $cerrar=oci_close($conn);
    $resultado = oci_fetch_array($resultado, OCI_ASSOC);
    $resultado = utf8ize($resultado);
    $datos = array('status' => true, 'datos' => $resultado);
    echo json_encode($datos);
}
else{
    $resultado = array('status' => false, 'message' => 'Connection error');
    echo json_encode($resultado);
}
function utf8ize($d) {
   if (is_array($d)) {
       foreach ($d as $k => $v) {
           $d[$k] = utf8ize($v);
       }
   } else if (is_string ($d)) {
       return utf8_encode($d);
   }
   return $d;
}
?>
