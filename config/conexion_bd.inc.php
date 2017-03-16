<?php
    require_once('bd-config.inc.php');
    //Conexion a la base de datos
    $conn = oci_connect(USERNAME, PASSWORD, TNS);
    if($conn){
      echo "hay conexion";
    }else{
      echo "no hay conexion";
    }
?>
