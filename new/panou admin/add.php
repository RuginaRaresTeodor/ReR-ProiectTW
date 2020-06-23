
<?php
require_once "config.php";
if( $_POST['id']!='' and $_POST['nume']!='' and $_POST['pass']!='' and $_POST['mail']!=''){
$sql = 'INSERT INTO userr '.
       'VALUES(:id, :nume, :parola, :adresa_mail)';

$compiled = oci_parse($link, $sql);
oci_bind_by_name($compiled, ':id', $_POST['id']);
oci_bind_by_name($compiled, ':nume', $_POST['nume']);
oci_bind_by_name($compiled, ':parola',$_POST['pass']);
oci_bind_by_name($compiled, ':adresa_mail',$_POST['mail']);
    
oci_execute($compiled);
}
 header("Refresh:0; url=admin.php");

    ?>