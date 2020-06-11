<?php


$servername = "localhost:1521/xe";
$username = "student";
$password = "student";

// Create connection
$conn =  oci_connect($username, $password,$servername,);
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
 }
 $stid = oci_parse($conn, 'SELECT * FROM userr');
 oci_execute($stid);
 
 echo "<table border='1'>\n";
 while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
     echo "<tr>\n";
     foreach ($row as $item) {
         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
     }
     echo "</tr>\n";
 }
 echo "</table>\n";

 $stid = oci_parse($conn, "SELECT nume||' '||parola FROM userr");
 oci_execute($stid);
 while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        $user= (explode(" ",$item));
        $bd_name=$user[0];
        $bd_pass=$user[1];
        echo ($item !== null ? $bd_name." ".$bd_pass: "&nbsp;");
    }
 } ?>