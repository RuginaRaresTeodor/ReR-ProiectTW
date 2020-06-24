<?php

$servername = "localhost:1521/xe";
$username1 = "student";
$password1 = "student";
$dbName = "baza_date";

$con = oci_connect($username1, $password1,$servername);
if (!$con){
      $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

?>