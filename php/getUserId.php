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
        $aux="1";

        //Select a la base de datos
        //$query="SELECT ID, CONTRASENA, PUNTOS from ac_usuario WHERE ID='${idUsuario}' AND CONTRASENA='${contrasena}'";

        $query="SELECT * FROM AC_USUARIO_VEHICULO WHERE CORREO='$correo'";

        $user= oci_parse($conn, $query);

        oci_execute($user);
        
        $row = oci_fetch_array($user, OCI_ASSOC);

        if($row){
            $res = array('status' => true, 'message' => 'Success query', 'data' => $row);
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