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
    $fecha_vigencia=$params[1];
    $tipo_vehiculo=$params[2];
    $linea=$params[3];
    $barrio=$params[4];
    $convenio=$params[5];
    $modelo=$params[6];
    $id_usuario=$params[7];
    $aseguradora=$params[8];
    $color_vehiculo=$params[9];
    //Estado como activo por defecto
    $estado=0; 

    //echo array($placa,$fecha_vigencia,$tipo_vehiculo,$linea,$barrio,$convenio,$modelo,$id_usuario,$aseguradora,$color_vehiculo);

    //Query de insercion de registro
    $query="INSERT INTO AC_VEHICULO(ID, PLACA, VIGENCIA_SOAT, TIPO_VEHICULO, LINEA, BARRIO, CONVENIO, MODELO, ESTADO, ID_USUARIO, ASEGURADORA, COLOR_VEHICULO) VALUES (VEHICULO_ID.NEXTVAL, '$placa', to_date('$fecha_vigencia','YYYY-MM-DD'), $tipo_vehiculo, $linea, $barrio, $convenio, $modelo, $estado, $id_usuario, $aseguradora, $color_vehiculo)";

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
