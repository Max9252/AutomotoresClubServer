<?php
header('Content-type: text/html');  

include
(
"conexion.php"
);

$params = explode(",",$argv[1]);
$correo= $params[0];
$contrasena= $params[1];
$puntos= 0;


$arrayDatosUsuario="INSERT INTO AC_USUARIO (Id, Correo, Contrasena, Estado) 
VALUES ('', ${correo}', '${contrasena}', 0)";

$ingresoDatosUsuario= oci_parse($conn, $arrayDatosUsuario);

$comprobacion=$oci_execute($ingresoDatosUsuario);

if($comprobacion){
    echo true;
}
else{
    echo false;
}
oci_close($conn);

?>
?>