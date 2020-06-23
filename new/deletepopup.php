<html>  
<head>  
<title>ShotDev.Com Tutorial</title>  
</head>  
<body>  
<?php
include 'config.php';
//$strSQL = "DELETE FROM link_feed ";  
$mes=explode("¬",$_GET["CusID"]);

$strSQL = "DELETE FROM link_feed ";  
$strSQL .="WHERE user_id = '".$mes[1]."' and feed_site='".$mes[0]."'";  
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
//header("Refresh:0; url=indexpopup.php");
header("Refresh:0; url=indexpopup.php");

?>  
</body>  
</html>  