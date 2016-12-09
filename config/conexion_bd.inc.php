<?php
require_once('bd-config.inc.php');
//Conexion a la base de datos
$conn = @oci_connect(USUARIO, PASSWORD, TNS);
if(!$conn){
    echo true;
}else{
    echo false;
}
?>