<?php

$servername = "localhost:1521/xe";
$username = "student";
$password = "student";

// Create connection
$link  =  oci_connect($username, $password,$servername);
if (!$link ) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
 }

 
 ?>