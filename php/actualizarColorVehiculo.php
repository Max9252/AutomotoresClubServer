<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    $params = explode(",",$argv[1]);
    $placa=$params[0];
    //echo array($placa,$fecha_vigencia,$tipo_vehiculo,$linea,$barrio,$convenio,$modelo,$id_usuario,$aseguradora,$color_vehiculo);

    //Query de insercion de registro
    $query="UPDATE";
    $vehiculo= oci_parse($conn, $query);

    $resul= oci_execute($vehiculo);

    if($resul){
        $res = array('status' => true, 'message' => 'Registro completo');
    }else{
        $res = array('status' => false, 'message' => 'Credenciales Invalidas');
    }
    oci_close($conn);
    echo json_encode($res);

}else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}
?>
