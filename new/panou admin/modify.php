
<?php
require_once "config.php";
 $stid = oci_parse($link, "UPDATE userr SET nume ='".$_POST['nume']."',
  adresa_mail= '".$_POST['mail']."',parola='".$_POST['pass']."' WHERE id_user =". $_POST["id"]);
 oci_execute($stid);
 header("Refresh:0; url=admin.php");

    ?>