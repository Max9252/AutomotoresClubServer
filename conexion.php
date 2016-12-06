<?php
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=bdpruebas.cz1bgcvtf2gf.us-west-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SID=ORCL)))";
$conn = oci_connect("Automotor", "automotores", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>