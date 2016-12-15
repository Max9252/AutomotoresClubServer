<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
   "config/conexion_bd.inc.php"
);
if($conn){
   // Variables traidas desde la funcion de javascript (cambiar por las del POST)
   $params = explode(",",$argv[1]);
   $placa='abc123';
   $fecha_vigencia="19960725";
   $tipo_vehiculo=1;
   $linea=100;
   $barrio=76410;
   $convenio=1;
   $modelo=2002;
   $id_usuario=1;
   $aseguradora=1;
   $color_vehiculo=1;
   //Estado como activo por defecto
   $estado=0; 
   $lob_upload = $params[0];

   $lob = OCINewDescriptor($conn, OCI_D_LOB);

   //Query de insercion de registro
   $query="INSERT INTO AC_VEHICULO(ID, PLACA, VIGENCIA_SOAT, TIPO_VEHICULO, LINEA, BARRIO, CONVENIO, MODELO, ESTADO, ID_USUARIO, ASEGURADORA, COLOR_VEHICULO, IMAGEN) VALUES (VEHICULO_ID.NEXTVAL, '$placa', to_date('$fecha_vigencia','YYYYMMDD'), $tipo_vehiculo, $linea, $barrio, $convenio, $modelo, $estado, $id_usuario, $aseguradora, $color_vehiculo, EMPTY_BLOB() ) returning IMAGEN into :the_blob";

   $stmt = OCIParse($conn, $query);

   OCIBindByName($stmt , ':the_blob',$lob, -1, OCI_B_BLOB);

   OCIExecute($stmt, OCI_DEFAULT);
   if($lob->savefile($lob_upload))
   {
       OCICommit($conn);
       $res = array('status' => true, 'message' => 'Registro completo');
   }
   else{
       $res = array('status' => false, 'message' => 'Credenciales Invalidas');
   }
   OCIFreeStatement($stmt);
   OCILogoff($conn);
   echo json_encode($res);
}else{
   $res = array('status' => false, 'message' => 'Connection error');
   echo json_encode($res);
}
?>