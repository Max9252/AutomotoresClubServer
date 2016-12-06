<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"

header('Content-type: text/html; charset=UTF-8');  
include(
    "conexion.php"
);
// Variables traidas desde la funcion de javascript (cambiar por las del POST)
$params = explode(",",$argv[1]);
$idUsuario= $params[0];
$contrasena= $params[1];
$aux="1";

//Select a la base de datos
//$query="SELECT ID, CONTRASENA, PUNTOS from ac_usuario WHERE ID='${idUsuario}' AND CONTRASENA='${contrasena}'";

$query="SELECT COUNT (ID) FROM AC_USUARIO WHERE ID='${idUsuario}' AND CONTRASENA='${contrasena}'";

$user= oci_parse($conn, $query);

oci_execute($user);

$cantidad=oci_fetch_array($user);

if(strcmp($cantidad[0], $aux) == 0){
    echo true;

}
else{
    echo false;
}
oci_close($conn);
?>