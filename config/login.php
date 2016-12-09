<?php

define("HOST", "automotores.c0nj4v6gtaky.us-east-1.rds.amazonaws.com");     // El host de la base de datos
define("USUARIO", "Automotor");    // El nombre de usuario de la base de datos
define("PASSWORD", "Automotor2016");    // La contraseña de la base de datos
define("SID", "ORCL");    // El nombre de la base de datos
define("TNS","(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=".HOST.")(PORT=1521))(CONNECT_DATA=(SID=".SID.")))"); //TNS de la conexion
define("SECURE", FALSE);    // 
//Conexion a la base de datos
$canal = @oci_connect(USUARIO, PASSWORD, TNS);
if(!$canal){
    echo "no hay conexion";
}

$email= "alejandro.garay94@gmail.com";
$contrasenaIngresada= "123456";
$tipoAcceso= "2";

if($tipoAcceso ==='2'){
    $sql="SELECT ID, USUARIO, CONTRASENA, ESTADO, ID_PROVEEDOR FROM AC_USUARIO_ADMINISTRADOR WHERE USUARIO= '${email}'";
    $resultado=oci_parse($canal,$sql);
    oci_execute($resultado);
    $cerrar=oci_close($canal);
    $row = oci_fetch_array($resultado, OCI_ASSOC);
    if($row){
        $contrasena=$row['CONTRASENA'];
        if ($contrasenaIngresada==$contrasena){
            if(true){ //validar estado
                $response_array['status'] = 'establecimiento';
            }else{
                $response_array['status'] = 'bloqueado';
            }
        }
        else{
            $response_array['status'] = 'invalido';
        }
    }
    else{
        $response_array['status'] = 'invalido';
    } 
}else{
    if($tipoAcceso ==='1'){
        $sql="SELECT ID, EMAIL_EMPRESA, CONTRASENA, ESTADO FROM AC_PROVEEDOR WHERE EMAIL_EMPRESA= '${email}'";
        $resultado=oci_parse($canal,$sql);
        oci_execute($resultado);
        $cerrar=oci_close($canal);
        $row = oci_fetch_array($resultado, OCI_ASSOC);
        if($row){
            $contrasena=$row['CONTRASENA'];
            if ($contrasenaIngresada==$contrasena){
                $id=$row['ID'];
                $estado=$row['ESTADO'];
                $contrasena = hash('sha512', $contrasena);
                if(true){ //validar estado
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    $_SESSION['login_string'] = hash('sha512', $contrasena . $user_browser);
                    $response_array['status'] = 'proveedor';
                }else{
                    $response_array['status'] = 'bloqueado';
                }
            }
            else{
                $response_array['status'] = 'invalido';
            }
        }
        else{
            $response_array['status'] = 'invalido';
        }
    }
    else{
        $response_array['status'] = 'error';
    }
}
echo json_encode($response_array);

?>