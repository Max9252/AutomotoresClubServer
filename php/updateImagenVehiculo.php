<?php
header('Content-type: text/html; charset=UTF-8');
header('Content-Type: application/json');
include(
    "config/conexion_bd.inc.php"
);
if($conn){

    $params = explode(",",$argv[1]);

    $id=$params[0];
    $url= $params[1];
    
    //Query de insercion de registro
    $cambioPass="UPDATE AC_VEHICULO SET URL_IMAGEN='${url}' WHERE ID = $id";}
echo $cambioPass;

    $resultado= oci_parse($conn, $cambioPass);

    oci_execute($resultado);

    if($resultado){

        $res = array('status' => true, 'message' => 'Update complete');

    }else{
        $res = array('status' => false, 'message' => 'Update failed');
    }

    echo json_encode($res);

}
else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}
?>