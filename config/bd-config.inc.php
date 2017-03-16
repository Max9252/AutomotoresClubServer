<?php

$dbhost = "aafoddpwdhgw8d.czwxja3kruql.us-west-2.rds.amazonaws.com";
$dbport = "1521";
$sid = "EBDB";
$charset = 'utf8' ;
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=".$dbhost.")(PORT=1521))(CONNECT_DATA=(SID=".$sid.")))";
$username = "Automotores";
$password = "Automotores2017";

define('TNS', $tns);
define('USERNAME', $username);
define('PASSWORD', $password);

?>
