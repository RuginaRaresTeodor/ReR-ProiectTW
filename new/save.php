<?php
header("Content-Type:application/json");

	include 'config.php';
	$msg1=$_GET['id'];
    $msg2=$_GET['site'];
    
if (isset($_GET['id'])and isset($_GET['site']) ){
	$sql = 'INSERT INTO link_feed '.
       'VALUES(:user_id, :feed_site)';

    $compiled = oci_parse($link, $sql);
    
    oci_bind_by_name($compiled, ':user_id', $msg1);
    oci_bind_by_name($compiled, ':feed_site', $msg2);

    oci_execute($compiled);
	
    echo 'success';
}
else
echo 'id si site null';
?>
 