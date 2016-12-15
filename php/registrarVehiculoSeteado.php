<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){
    // Variables traidas desde la funcion de javascript (cambiar por las del POST)
    $placa='abc123';
    $fecha_vigencia="19960725";
    $tipo_vehiculo=1;
    $linea=100;
    $barrio=764102;
    $convenio=1;
    $modelo=2002;
    $id_usuario=1;
    $aseguradora=1;
    $color_vehiculo=1;
    //Estado como activo por defecto
    $estado=0; 

    //Query de insercion de registro
    $query="INSERT INTO AC_VEHICULO(ID, PLACA, VIGENCIA_SOAT, TIPO_VEHICULO, LINEA, BARRIO, CONVENIO, MODELO, ESTADO, ID_USUARIO, ASEGURADORA, COLOR_VEHICULO) VALUES (VEHICULO_ID.NEXTVAL, '$placa', to_date('$fecha_vigencia','YYYYMMDD'), $tipo_vehiculo, $linea, $barrio, $convenio, $modelo, $estado, $id_usuario, $aseguradora, $color_vehiculo)";

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

