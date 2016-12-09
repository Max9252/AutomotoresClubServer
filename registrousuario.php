<?php
header('Content-type: text/html');  

include(
    "config/conexion_bd.inc.php"
);

if($conn){
    $params = explode(",",$argv[1]);
    $correo= $params[0];
    $contrasena= $params[1];

    $arrayDatosUsuario="INSERT INTO AC_USUARIO_VEHICULO (Id, Correo, Contrasena, Estado) 
    VALUES (USUVEHICULO_ID.NEXTVAL, '$correo', '$contrasena', 0)";

    $ingresoDatosUsuario= oci_parse($conn, $arrayDatosUsuario);

    $comprobacion=$oci_execute($ingresoDatosUsuario);

    if($comprobacion){
        $res = array('status' => true, 'message' => 'Success signUp');
        echo json_encode($res);
    }
    else{
        $res = array('status' => false, 'message' => 'Error on signUp');
        echo json_encode($res);
    }
    oci_close($conn);
}else{
    $res = array('status' => false, 'message' => 'Connection error');
    echo json_encode($res);
}

?>