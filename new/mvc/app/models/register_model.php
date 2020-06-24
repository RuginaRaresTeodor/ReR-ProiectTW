 <?php
// Include config file
require_once "config.php";

$stid = oci_parse($link, "SELECT id_user FROM userr order by id_user desc");
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
foreach ($row as $item) {
    $A_id=$item;
    break;} 
$username = $password = $confirm_password = $mail= "";
$username_err = $password_err = $confirm_password_err = $mail_err="";
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['register'])){

    $unume=trim($_POST["username"]);
    $umail=trim($_POST["mail"]);
    $url = "http://localhost:2000/new/apiUser.php?id_adresa='".$unume."'";
    $url2 = "http://localhost:2000/new/apiUser.php?id_adresa='".$umail."'";

 
$client = curl_init($url);
$client2 = curl_init($url2);

curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
$result = json_decode($response);
$numm=trim($result->nume);
$mmail=trim($result->adresa_mail);

curl_setopt($client2,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client2);
$result = json_decode($response);
$numm2=trim($result->nume);
$mmail2=trim($result->adresa_mail);
// Validate username
    
   
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Please enter a mail.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(trim($_POST["username"])==$numm or trim($_POST["username"])==$numm2){
        $username_err = "This username is taken.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(trim($_POST["mail"])==$mmail or trim($_POST["mail"])==$mmail2){
        $mail_err = "This mail is taken.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(($_POST["confirm_password"])!=($_POST["password"]))
    {
        $confirm_password_err = "Passwords entered do not match";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else{
  
$sql = 'INSERT INTO userr '.
       'VALUES(:id, :nume, :parola, :adresa_mail)';

$compiled = oci_parse($link, $sql);
$A_id2=($A_id)+1;
oci_bind_by_name($compiled, ':id', $A_id2);
oci_bind_by_name($compiled, ':nume', $_POST['username']);
oci_bind_by_name($compiled, ':parola',$_POST['password']);
oci_bind_by_name($compiled, ':adresa_mail',$_POST['mail']);
    
oci_execute($compiled);}}

?>