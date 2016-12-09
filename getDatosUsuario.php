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
        $correo= $params[0];
        $contrasena= $params[1];
        $aux="1";
        $auth = false;

        //Select a la base de datos
        //$query="SELECT ID, CONTRASENA, PUNTOS from ac_usuario WHERE ID='${idUsuario}' AND CONTRASENA='${contrasena}'";

        $query="SELECT * FROM AC_USUARIO_VEHICULO WHERE";

        $user= oci_parse($conn, $query);

        oci_execute($user);

        while(($row = oci_fetch_array($stid, OCI_ASSOC)) != false){
            if($row['correo']==$correo&&$row['contrasena']==$contrasena){
                $auth=true;
            }
            else{
                $auth=false;
            }
        }

        if($auth){
            $res = array('status' => true, 'message' => 'Success login');
        }else{
            $res = array('status' => false, 'message' => 'Invalid credentials');
        }

        oci_close($conn);
        echo json_encode($res);
        
    }else{
        $res = array('status' => false, 'message' => 'Connection error');
        echo json_encode($res);
    }

?>