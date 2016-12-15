<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    $params = explode(",",$argv[1]);
    $id_vehiculo=$params[0];
    //Query de insercion de registro
    $query="SELECT A.PLACA, B.NOMBRE AS LINEA, C.NOMBRE AS CLASE_VEHICULO FROM AC_VEHICULO A, AC_P_LINEA B, AC_P_CLASE_VEHICULO C, AC_P_MARCA D WHERE A.ID_USUARIO= $id_vehiculo AND  A.LINEA=B.CODIGO AND B.MARCA= D.CODIGO AND D.CLASE_VEHICULO=C.CODIGO";

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



