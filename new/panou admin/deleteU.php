<html>  
<head>  
<title></title>  
</head>  
<body>  
<?php
include 'config.php';
//$strSQL = "DELETE FROM link_feed ";  
$mes=$_GET["id"];

$strSQL = "DELETE FROM userr ";  
$strSQL .="WHERE id_user = '".$mes."'";  
$objParse = oci_parse($link, $strSQL);  
$objExecute = oci_execute($objParse, OCI_DEFAULT);  
if($objExecute)  
{  
oci_commit($link); // Commit Transaction 
echo "Record Deleted.";  
}  
else  
{  
oci_rollback($link); // RollBack Transaction 
$e = oci_error($objParse);  
echo "Error Delete [".$e['message']."]";  
}  
oci_close($link); 
header("Refresh:0; url=admin.php");

?>  
</body>  
</html>  