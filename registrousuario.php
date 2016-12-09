<?php

    header('Content-type: text/html; charset=UTF-8');
    header('Content-Type: application/json');

    include(
        "config/conexion_bd.inc.php"
    );

    if($conn){
        $params = explode(",",$argv[1]);
        $correo= $params[0];
        $contrasena= $params[1];
        $emailExist = false;

        $emailVerificationArray = "SELECT * FROM AC_USUARIO_VEHICULO";

        $user= oci_parse($conn, $emailVerificationArray);

        oci_execute($user);

        while(($row = oci_fetch_array($stid, OCI_ASSOC)) != false){
            if($row['correo']==$correo){
                $emailExist=true;
            }
            else{
                $emailExist=false;
            }
        }

        if($emailExist){
            $res = array('status' => false, 'message' => 'Email already exist');
        }else{
            $arrayDatosUsuario="INSERT INTO AC_USUARIO_VEHICULO (Id, Correo, Contrasena, Estado) 
            VALUES (USUVEHICULO_ID.NEXTVAL, '$correo', '$contrasena', 0)";

            $ingresoDatosUsuario= @oci_parse($conn, $arrayDatosUsuario);

            $comprobacion= @oci_execute($ingresoDatosUsuario);

            if($comprobacion){
                $res = array('status' => true, 'message' => 'Success signUp');
            }
            else{
                $res = array('status' => false, 'message' => 'Error on signUp');
            }
        }
        
        oci_close($conn);
        echo json_encode($res);

    }else{
        $res = array('status' => false, 'message' => 'Connection error');
        echo json_encode($res);
    }

?>