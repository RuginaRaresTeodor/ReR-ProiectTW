<?php
// Include config file

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['remember']))
{
    remember();
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['relogin']))
{
    relogin();
}
function remember() {
    echo "The remember function is called.";
    $salt = substr (md5("$_POST[password]"), 0, 2);
    $cookie = base64_encode ("$_POST[username]:" . md5 ("$_POST[password]", $salt));
    $cookie2 = base64_encode ("$_POST[password]:" . md5 ("$_POST[password]", $salt));

    setcookie ('my-secret-cookie-U', $cookie);
    setcookie ('my-secret-cookie-P', $cookie2);

    echo $cookie[0];
    $content = base64_decode ($cookie);
    echo $content[0];
}
function relogin() {
    echo "The relogin function is called.";
    $cookie = $_COOKIE['my-secret-cookie-U'];
    $cookie2 = $_COOKIE['my-secret-cookie-P'];

}


$username = $password = $confirm_password = $mail= "";
$username_err = $password_err = $confirm_password_err = $mail_err="";
$message="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   session_start();
$servername = "localhost:1521/xe";
$username1 = "student";
$password1 = "student";

if(count($_POST)>0) {
$con = oci_connect($username1, $password1,$servername);
$result = oci_parse($con,"SELECT * FROM userr WHERE nume='" . $_POST["username"] . "' and parola = '". $_POST["password"]."'");
oci_execute($result);
$stack = array();
$null=array();
while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        //$user= (explode(" ",$item));
        //$bd_name=$user[0];
        //$bd_pass=$user[1];
        array_push($stack,$item);
        //echo ($item !== null ? $stack[0]: "&nbsp;");
    }
 }
 if($stack!=$null) {
    $_SESSION["id"] = $stack[0];
    $_SESSION["name"] = $stack[1];
    

    } else {
    $message = "Invalid Username or Password!";
    }
}
}
if(isset($_SESSION["id"])) {
    header("Location:logedon.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<form name="frmUser" method="post" action="" >
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 >Enter Login Details</h3>
 Username:<br>
 <input type="text" name="username" >
 <br>
 Password:<br>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit" value="Submit">
<input type="reset">
<input type="submit" class="button" name="remember" value="remember" />
<input type="submit" class="button" name="relogin" value="relogin" />

</form>
</body>
</html>