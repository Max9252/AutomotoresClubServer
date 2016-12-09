<?php
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=automotores.c0nj4v6gtaky.us-east-1.rds.amazonaws.com:1521)(PORT=1521))(CONNECT_DATA=(SID=ORCL)))";
$conn = oci_connect("Automotor", "automotores", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>