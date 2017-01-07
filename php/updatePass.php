<?php
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){

    $params = explode(",",$argv[1]);
    $contrasena=$params[0];
    $id= $params[1];

    //Query de insercion de registro
    $query="UPDATE AC_USUARIO_VEHICULO SET CONTRASENA='${contrasena}' WHERE ID='${id}'";

    $resultado= @oci_parse($conn, $query);

    oci_execute($resultado);

    if($resultado){
        $query2 = "SELECT CONTRASENA FROM AC_USUARIO_ADMINISTRADOR WHERE ID='${id}'";

        $contrasena= oci_parse($conn, $query2);

        $resul2= @oci_execute($contrasena);

        $aux= oci_fetch_array($contrasena, OCI_ASSOC);

        if ($aux['CONTRASENA'] === $contrasena) {    
            $res = array('status' => true, 'message' => 'Update complete');
        }else{
            $res = array('status' => false, 'message' => 'Update failed');
        }

    }else{
        $res = array('status' => false, 'message' => 'Update failed');
    }


}
else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}
?>