

<html>

<head>
  <title>Recon</title>
  <meta name="description" content="We recon for you!">
  <meta name="author" content="Rares Rugina & Marius Roman">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="profile.png" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/tabel.css">

  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="json/fun.js"></script>
  <script type="text/javascript" src="json/gfapi.js"></script>
  <script type="text/javascript" src="json/feeds.js"></script>
  <style type="text/css">
    td
      {
       padding:0 15px;
      }
</style>

</head>

<body>
<?php
 $aOrB=0;
session_start();

if(!isset($_SESSION["id"])){
    $_SESSION["id"] = UniqueMachineID();
    $_SESSION["name"] = "guest";}
    function UniqueMachineID($salt = "") {  
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {  
              
            $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";  
            if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");  
            $output = shell_exec("diskpart /s ".$temp);  
            $lines = explode("\n",$output);  
            $result = array_filter($lines,function($line) {  
                return stripos($line,"ID:")!==false;  
            });  
              
              
            if(count($result)>0) {  
                $result = array_shift(array_values($result));  
                $result = explode(":",$result);  
                $result = trim(end($result));         
            } else $result = $output;         
        } else {  
            $result = shell_exec("blkid -o value -s UUID");    
            if(stripos($result,"blkid")!==false) {  
                $result = $_SERVER['HTTP_HOST'];  
            }  
        }     
        $str = preg_replace('/\D/', '', md5($salt.md5($result)));

        return $str;  
    }  
      
    
?>
<?php

       require_once "config.php";
       $quer="SELECT * FROM feeds";
       $idx=$_SESSION["id"];
       //$quer1="SELECT feed_site FROM link_feed where user_id="."'$idx'";
       if(($aOrB)==1)$quer=$quer1;
       $stid = oci_parse($link, $quer);
       oci_execute($stid);
       while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          foreach ($row as $item) {
              //echo $item." ad\n  ";
              $g="start("."'$item'".")";
              echo '<script type="text/javascript">'.$g.';</script>';

          }}
         

?>
<?php
// Include config file

$username = $password = $confirm_password = $mail= "";
$username_err = $password_err = $confirm_password_err = $mail_err="";
$message="";

if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])){
 
$servername = "localhost:1521/xe";
$username1 = "student";
$password1 = "student";

if(count($_POST)>0) {
$con = oci_connect($username1, $password1,$servername);

$enquiry="BEGIN GET_ONE_USER"."("."'".$_POST['username']."'".",:pass,:id_user);end;";
$stid = oci_parse($con, $enquiry);
oci_bind_by_name($stid,':pass',$rpassword,38);
oci_bind_by_name($stid,':id_user',$id_user,20);

oci_execute($stid);

 if($rpassword!=null and $rpassword==$_POST['password']) {
    $_SESSION["id"] = $id_user;
    $_SESSION["name"] = $_POST['username'];

    } else {
    $message = "Invalid Username or Password!";
    }
}
if(isset($_SESSION["id"])and $_SESSION["id"]!=UniqueMachineID()) {
    //echo '<script type="text/javascript">changepage3();</script>';

    header("Location:index.php");
}


}
?>
  <div class="nav">
    <img src="logo.svg" alt="logo">
    <div class="nav-button" id="acc" onclick="changepage1()">feed</div>
    <!-- <div class="nav-button" id="poc" ><a href="logedon.php">your place</a></div> -->
    <!-- <div class="nav-button" onclick="changefromlogin()">settings</div> -->
    <div class="nav-button" onclick="changepage3()">your place</div>
    <div class="nav-button" onclick="changepage2()">Home</div>
    <div class="menu" onclick="menufunction()">Menu</div>
    
  </div>
  <div class="full-menu">
    <div class="nav-button"  onclick="changepage1()">feed</div>
    <div class="nav-button" onclick="changepage3()">your place</div>
    <div class="nav-button" onclick="changepage2()">Home</div>
  </div>
  <div class="first-page">
    <div class="left">
      <h1>What is Recon?</h1>
      <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recon helps you find things you like easier. <br>Just select sites you
        want your info to come from.</h3>
    </div>
    <div class="right">
      <div id="wrapper">
        <div class="form-container">
          <span class="form-heading">Login</span>
          <form method="post">
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
            <a href="#" style="text-decoration:none; font-size: 1.2rem;">Forgot password?</a>
            <div class="input-group">
              <button type="submit" name="login" value="login">
                <span style>Login &nbsp;</span><i class="fas fa-sign-in-alt"></i>
                           

              </button>
              <button type="submit" onclick="changepageregister()">
              <span style>Register &nbsp;</span><i class="fas fa-sign-in-alt"></i>

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
              <a href="#">Do not have an account? <span onclick="changepageregister()">Register</span></a>
            </div>
            <span>Or be our:</span>
            <button>
              <b class="guest">Guest</b>
            </button>
          </div>
        </div>


        <div class="userdetails">
            <?php
        if(isset( $_SESSION["name"]))
            $name=$_SESSION["name"];
            else 
            $name="Guest";
            ?>
          <span class="form-heading"><?php echo $name; ?></span>
          <a href="logout.php" tite="Logout">Logout.</a>
         
        
        </div>
      </div>
    </div>
  </div>
  <div class="second-page">
    <div class="dw" id="dut">
    </div>
  </div>
  <div class="register-page" >
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
    $url = "http://localhost:2000/rares/apiUser.php?id_adresa='".$unume."'";
    $url2 = "http://localhost:2000/rares/apiUser.php?id_adresa='".$umail."'";

 
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


    <div id="wrapper2">
      <div class="form-container">
        <span class="form-heading">&nbsp;SIGN UP</span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <div class="input-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>" >
            <input type="text" placeholder="Email adress..." name="mail" class="input-control" value="<?php echo $mail; ?>">
            <span class="help-block"><?php echo $mail_err; ?></span>
          </div>

          <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input type="text" placeholder="Username desired..." name="username" class="input-control" value="<?php echo $username; ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
          </div>

          <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" placeholder="Password..."  name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
          </div>

          <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <input type="password" placeholder="Repeat password..."  name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
          </div>
          <br>
          <div class="input-group">
          
            <input type="submit" class="button"  name="register" value="register">
          </div>
          <div class="input-group">
          
            
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
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
        </div>
        <div class="anunt"><p>By creating an account, you agree to the Terms of Service. For more information about Recon's privacy practices, see the Recon Privacy Statement. We'll occasionally send you account-related emails.</p></div>
      </div>
    </div>
  </div>
  <div class="selector">
  
<?php
// Include config file
require_once "config.php";

$stid = oci_parse($link, "SELECT id_adresa FROM adresa order by id_adresa desc");
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
foreach ($row as $item) {
    $A_id=$item;
    break;} 

$k_titlu = $k_domeniu = $k_link = "";
$k_titlu_err = $k_domeniu_err = $k_link_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["k_titlu"]))){
        $username_err = "Please enter a title.";
    } else
    if(empty(trim($_POST["k_domeniu"]))){
        $mail_err = "Please enter a domain.";
    } else
    if(empty(trim($_POST["k_link"]))){
        $password_err = "Please enter a link adress.";
    } 
    else{
$A_id2=($A_id)+1;
$sql = 'INSERT INTO adresa '.
       'VALUES(:id, :titlu, :domeniu, :link_site)';

$compiled = oci_parse($link, $sql);

oci_bind_by_name($compiled, ':id', $A_id2);
oci_bind_by_name($compiled, ':titlu', $_POST['k_titlu']);
oci_bind_by_name($compiled, ':domeniu',$_POST['k_domeniu']);
oci_bind_by_name($compiled, ':link_site',$_POST['k_link']);
    
oci_execute($compiled);

$sql = 'INSERT INTO link_feed '.
       'VALUES(:user_id, :feed_site)';

$compiled = oci_parse($link, $sql);

oci_bind_by_name($compiled, ':user_id', $_SESSION["id"]);
oci_bind_by_name($compiled, ':feed_site',  $_POST['k_link']);

oci_execute($compiled);
}}
?>
<div class="register-page2">
<div class="form-container">
      
        
      


<?php
$conn  =  oci_connect('student', 'student','localhost:1521/xe');
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
 }
if($_SESSION["id"])
$id=$_SESSION["id"];
else
$id=$_SESSION["id"];
$stid = oci_parse($conn, "SELECT feed_site FROM link_feed where user_id=$id");
oci_execute($stid);
$pars=array();
$parsL=array();

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
   foreach ($row as $item) {
      
       //echo ($item !== null ? $item." ": "&nbsp;");
       
  
      # $order_id = $_POST['id_adresa'];
       $url = "http://localhost:2000/new/api.php?link_site=".trim($item);
 
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
 
        $result = json_decode($response);
        array_push($pars,trim($result->domeniu)); 
        array_push($parsL,trim($item)); 

   }
} 
$domain = array_unique($pars);

foreach ($domain as $i){
  if($i!="200"){
    echo '<div class="topleft">';
    echo "<table class='minimalistBlack'>";
    echo "<thead><tr><th>Domeniu:$i</th><th>Delete</th></tr></thead><tbody>";
#echo "#".$i."#";
$sti = oci_parse($conn, "SELECT titlu||'#'||link_site FROM adresa where domeniu='$i'");
oci_execute($sti);
while ($row = oci_fetch_array($sti, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        $user= (explode("#",$item));
        $bd_titlu=$user[0];
        $bd_link=trim($user[1]);
        $two=trim($bd_link."k".$id);
        #echo ($item !== null ? $bd_titlu." ".$bd_link."#": "&nbsp;");
        if(in_array($bd_link,$parsL)){
        echo '<tr><td><a href="getrss.php?l='.$bd_link.'">'.$bd_titlu.'</a></td>
        <td align="center"><a href="delete.php?CusID='.$two.'">Delete</a></td>  </tr>';
        }
    }
 } echo "</tbody></table></br>";
 echo "</div>";

}
}
if(isset($_SESSION["id"]) and $_SESSION["id"]<1111111)
{
    //echo '<script type="text/javascript">changepage3();</script>';
    echo '<script type="text/javascript">changefromlogin();</script>';
}
    else
    echo '<script type="text/javascript">changetologin();</script>';




    ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($k_titlu_err)) ? 'has-error' : ''; ?>">
                <label>Title</label>
                <input type="text" name="k_titlu" class="form-control" value="<?php echo $k_titlu; ?>">
                <span class="help-block"><?php echo $k_titlu_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($k_domeniu_err)) ? 'has-error' : ''; ?>">
                <label>Domain</label>
                <input type="text" name="k_domeniu" class="form-control" value="<?php echo $k_domeniu; ?>">
                <span class="help-block"><?php echo $k_domeniu_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($k_link_err)) ? 'has-error' : ''; ?>">
                <label>Feed address</label>
                <input type="text" name="k_link" class="form-control" value="<?php echo $k_link; ?>">
                <span class="help-block"><?php echo $k_link_err; ?></span>
            </div> 

       
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
<?php
echo "<div class='form-group'>";
echo '[id-ul tau este '.$_SESSION["id"].']';

if($_SESSION["name"]) {
?>
Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.</a>
</br>
</div>
<?php
}else echo "<h1>Please login first .</h1>";
?>
  
   
  </div>
  </div>
  </div>
  
  <script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
(function($)
{
    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {
                $('#loading').hide();
                $('#content').show();
            }
        });
        var $container = $("#content");
        $container.load("popup.php");
        var refreshId = setInterval(function()
        {
            $container.load('popup.php');
        }, 60000);
    });
})(jQuery);
</script>
  <div id="content"></div>
</body>

</html>


