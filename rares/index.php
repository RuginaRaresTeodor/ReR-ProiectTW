<!DOCTYPE html>

<?php
// Include config file

$username = $password = $confirm_password = $mail= "";
$username_err = $password_err = $confirm_password_err = $mail_err="";
$message="";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])){
 
$servername = "localhost:1521/xe";
$username1 = "student";
$password1 = "student";

if(count($_POST)>0) {
$con = oci_connect($username1, $password1,$servername);
$result = oci_parse($con,"SELECT * FROM userr WHERE nume='" . $_POST["username"] . "'or adresa_mail='" . $_POST["username"] . "' and parola = '". $_POST["password"]."'");
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
if(isset($_SESSION["id"])and $_SESSION["id"]!="99") {
    header("Location:logedon.php");
}


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
  <script src="json/fun.js"></script>
</head>

<body>
  <div class="nav">
    <img src="logo.svg" alt="logo">
    <div class="nav-button" id="acc" onclick="changepage1()">feed</div>
    <div class="nav-button" id="poc" ><a href="logedon.php">your place</a></div>
    <div class="nav-button" onclick="changefromlogin()">settings</div>
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
         
        
        </div>
      </div>
    </div>
  </div>
  <div class="second-page">
    <div class="dw">
      <div class="dw-pnl dw-pnl--fcs">
        <div class="dw-pnl__cntnt bd--white tx--white">
          <h1>Pure CSS masonry layout</h1>
        </div>
      </div>
      <div class="dw-pnl">
        <div class="dw-pnl__cntnt bd--white tx--white">
          <ul>
            <li>Configurable</li>
            <li>Responsive</li>
            <li>Supports clusters</li>
          </ul>
        </div>
      </div>
      <div class="dw-pnl "><img src="https://unsplash.it/419/?random" class="dw-pnl__cntnt" alt="random" />
      </div>
      <div class="dw-pnl ">
        <div class="dw-pnl__cntnt tx--white bd--white">
          <p>Phasellus malesuada, urna non auctor viverra, libero ex pellentesque urna, id rhoncus eros lacus tristique
            risus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
        </div>
      </div>
      <div class="dw-pnl ">
        <img src="https://unsplash.it/445/?random" class="dw-pnl__cntnt" alt="random"/>
      </div>
      <div class="dw-pnl ">
        <img src="https://unsplash.it/423/?random" class="dw-pnl__cntnt" alt="random" />
      </div>
      <div class="dw-pnl dw-clstr dw-clstr--hrz">
        <div class="dw-clstr__sgmnt dw-clstr__sgmnt--rw ">
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>How</h2>
            </div>
          </div>
        </div>
        <div class="dw-clstr__sgmnt dw-clstr__sgmnt--rw ">
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>about</h2>
            </div>
          </div>
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>clusters?</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="dw-pnl ">
        <img src="https://unsplash.it/420/?random" class="dw-pnl__cntnt" alt="random"/>
      </div>
      <div style="height: 200px;" class="dw-pnl dw-flp">
        <div class="dw-pnl__cntnt dw-flp__cntnt">
          <div class="dw-flp__pnl dw-flp__pnl--frnt tx--white bd--white tx--center">
            <h1>You can flip me round</h1>
          </div>
          <div class="dw-flp__pnl dw-flp__pnl--bck bd--white tx--white tx--center">
            <h1>Yeah that's right</h1>
          </div>
        </div>
      </div>
      <div class="dw-pnl dw-clstr dw-clstr--vrt">
        <div class="dw-clstr__sgmnt dw-clstr__sgmnt--clmn ">
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>A</h2>
            </div>
          </div>
        </div>
        <div class="dw-clstr__sgmnt dw-clstr__sgmnt--clmn ">
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>vertically</h2>
            </div>
          </div>
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>flowed</h2>
            </div>
          </div>
          <div class="dw-pnl dw-clstr__sgmnt ">
            <div class="dw-pnl__cntnt bd--white tx--white">
              <h2>cluster</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="dw-pnl "><img src="https://unsplash.it/424/?random" class="dw-pnl__cntnt" alt="random" />
      </div>
      <div class="dw-pnl ">
        <div class="dw-pnl__cntnt bd--white bg--darkred tx--white">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu justo ex. Praesent mollis augue sagittis
            eros pharetra feugiat. Phasellus dignissim est lacus. Sed nec imperdiet dolor, sit amet mattis ex. Sed sed
            augue eu neque tristique commodo. Mauris aliquet tortor sollicitudin nibh molestie, id egestas nisl
            sollicitudin. Aliquam erat volutpat. Donec quis ultrices ligula. Cras sed purus risus. Curabitur quis eros
            eu tortor semper eleifend. Pellentesque lorem elit, dignissim interdum massa id, malesuada rutrum ligula.
            Suspendisse tempor quis mauris eu facilisis. Phasellus non volutpat diam, non dapibus ligula. Ut non
            molestie ex, nec sagittis mi. Curabitur suscipit tellus id dolor pretium blandit. Cras tristique tristique
            pharetra.</p>
        </div>
      </div>
      <div class="dw-pnl "><img src="https://unsplash.it/425/?random" class="dw-pnl__cntnt" alt="random" />
      </div>
      <div class="dw-pnl dw-pnl--fcs">
        <div class="dw-pnl__cntnt tx--white bd--white tx--center">
          <h1>Focus on hover</h1>
        </div>
      </div>
      <div class="dw-pnl ">
        <div class="dw-pnl__cntnt tx--white bd--white">
          <h2>Title for some content</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu justo ex. Praesent mollis augue sagittis
            eros pharetra feugiat. Phasellus dignissim est lacus. Sed nec imperdiet dolor, sit amet mattis ex. Sed sed
            augue eu neque tristique commodo. Mauris aliquet tortor sollicitudin nibh molestie, id egestas nisl
            sollicitudin. Aliquam erat volutpat. Donec quis ultrices ligula. Cras sed purus risus. Curabitur quis eros
            eu tortor semper eleifend.</p>
        </div>
      </div>
      <div class="dw-pnl dw-pnl--pls">
        <div class="dw-pnl__cntnt tx--white bd--white bg--darkred tx--center">
          <h1>Pulse on hover</h1>
        </div>
      </div>
      <div class="dw-pnl "><img src="https://unsplash.it/440/?random" class="dw-pnl__cntnt" alt="random"/>
      </div>
      <div class="dw__fcs-crtn"></div>
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
   $r=0;
$username = $password = $confirm_password = $mail= "";
$username_err = $password_err = $confirm_password_err = $mail_err="";
if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['register'])){
  $r=1;
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        echo '<script type="text/javascript">changepageregister();</script>';
    } else
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Please enter a mail.";
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
    
  </div>
    
    
</body>
</html>