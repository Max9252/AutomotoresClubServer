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
    while($row = oci_fetch_assoc($resultado))
    {
        $rows[] = $row;
    }
    $datos = array('status' => true, 'datos' => $rows);
    echo json_encode($datos);
}
?>



