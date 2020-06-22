<?php
	include 'config.php';
	$msg1=$_POST['id'];
    $msg2=$_POST['site'];
    

	$sql = 'INSERT INTO link_feed '.
       'VALUES(:user_id, :feed_site)';

    $compiled = oci_parse($link, $sql);
    
    oci_bind_by_name($compiled, ':user_id', $msg1);
    oci_bind_by_name($compiled, ':feed_site', $msg2);

    oci_execute($compiled);
	
    echo 'json_encode(array("statusCode"=>200))';
?>
 