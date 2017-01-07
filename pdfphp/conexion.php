<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=automotores.c0nj4v6gtaky.us-east-1.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SID=ORCL)))";
$conn = oci_connect("Automotor", "Automotor2016", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

echo "Conexion realizada exitosamente"; 


?>