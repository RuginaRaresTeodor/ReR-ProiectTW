
<?php
require_once "config.php";
if( $_POST['id_user']!='' and $_POST['link']!=''){
$sql = 'INSERT INTO link_feed '.
       'VALUES(:user_id, :feed_site)';

$compiled = oci_parse($link, $sql);
oci_bind_by_name($compiled, ':user_id', $_POST['id_user']);
oci_bind_by_name($compiled, ':feed_site', $_POST['link']);

    
oci_execute($compiled);
}
 header("Refresh:0; url=admin.php");

    ?>