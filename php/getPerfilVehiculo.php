<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    $params = explode(",",$argv[1]);
    $idVehiculo=$params[0];
    //Query de insercion de registro
    $query="SELECT A.PLACA, A.MODELO, A.VIGENCIA_SOAT, A.URL_IMAGEN,B.NOMBRE AS TIPO_SERVICIO, C.NOMBRE AS LINEA, D.NOMBRE AS MARCA, E.NOMBRE AS COLOR, F.CODIGO AS DEPARTAMENTO, G.CODIGO AS CIUDAD, H.NOMBRE_COMUNA AS COMUNA, I.NOMBRE AS ASEGURADORA, J.CODIGO AS BARRIO FROM AC_VEHICULO A, AC_P_SERVICIO_VEHICULO B, AC_P_LINEA C, AC_P_MARCA D, AC_P_COLOR E, AC_P_DEPARTAMENTO F, AC_P_CIUDAD G,AC_P_COMUNA H, AC_P_ASEGURADORA I, AC_P_BARRIO J WHERE A.TIPO_VEHICULO= B.CODIGO AND A.LINEA=C.CODIGO AND C.MARCA= D.CODIGO AND A.COLOR_VEHICULO= E.CODIGO AND A.BARRIO= J.CODIGO AND J.CODIGO_COMUNA=H.CODIGO AND H.CODIGO_CIUDAD=G.CODIGO AND G.CODIGO_DEPARTAMENTO= F.CODIGO AND A.ID=$idVehiculo AND A.ASEGURADORA=I.CODIGO";

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
