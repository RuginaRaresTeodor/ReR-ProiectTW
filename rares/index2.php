<!DOCTYPE html>
<?php
// Include config file

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
<html>
    <head>
        <title>Recon</title>
        <meta name="description" content="We recon for you!">
        <meta name="author" content="Rares Rugina & Marius Roman">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="profile.png" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <div class="nav">
            <img src="logo.svg" alt="logo">
            <div class="nav-button" id="acc">account</div>
            <div class="nav-button" >buton</div>
            <div class="nav-button">buton</div>
        </div>
        <div class="first-page">
            <div class="left">
                <h1>What is Recon?</h1>
                <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recon helps you find things you like easier. <br>Just select sites you want your info to come from.</h3>
            </div>
            <div class="right">
                <div id="wrapper">
                    <div class="form-container">
                        <span class="form-heading">Login</span>
                        <form method="post" action="">
                            <div class="message"><?php if($message!="") { echo $message; } ?></div>
                            <div class="input-group">
                                <input type="text" name="username" placeholder="Email or username..." required>
                                <span class="bar"></span>
                            </div>
            
                            <div class="input-group">
                                <input type="password" name="password" placeholder="Password..." required>
                                <span class="bar"></span>
                            </div>
                            <br>
                            <a href="#" style="text-decoration:none; font-size: 1.2rem;" >forgot password?</a>
                            <div class="input-group">
                                <button>
                                    <span style=>Login &nbsp;</span><i class="fas fa-sign-in-alt"></i>
                                </button>
                            </div>
                        </form>
                        <div class="social-login">

                                <span>Or sign up with:</span>
                                <div class="social-icons">
                                    <button>
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button>
                                        <i class="fab fa-google"></i>
                                    </button>
                                    <button>
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                </div>
                                
                                <div class="switch-login">
                                    <a href="#">Do not have an account? <span>Register</span></a>
                                </div>
                            </div>
                            
            
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>