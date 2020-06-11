<!DOCTYPE html>
<style type="text/css">
td
{
    padding:0 15px;
}
</style>

<?php
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

$sql = 'INSERT INTO relatii '.
       'VALUES(:user_id, :adresa_id, :r_code, :r_desc)';

$compiled = oci_parse($link, $sql);

oci_bind_by_name($compiled, ':user_id', $_SESSION["id"]);
oci_bind_by_name($compiled, ':adresa_id',  $A_id2);
oci_bind_by_name($compiled, ':r_code',$A_id2);
oci_bind_by_name($compiled, ':r_desc',$A_id2);
oci_execute($compiled);
}}
?>
 
<html>

<head>
  <title>Recon</title>
  <meta name="description" content="We recon for you!">
  <meta name="author" content="Rares Rugina & Marius Roman">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="profile.png" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="tabel.css">

  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
  <div class="nav">
    <img src="logo.svg" alt="logo">
    <div class="nav-button" id="acc" onclick="changepage1()">feed</div>
    <div class="nav-button" onclick="changepage3()">settings</div>
    <div class="nav-button" onclick="changepage2()">Home</div>
  </div>
  <div class="register-page2"  >
   
      <div class="form-container">
        </br>  </br>  </br>  </br>
        
      


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
$stid = oci_parse($conn, "SELECT adresa_id FROM relatii where user_id=$id");
oci_execute($stid);
//vezi ce domenii ai si la final parcurgi domeniu cu domeniu
$pars=array();
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
   foreach ($row as $item) {
      
       //echo ($item !== null ? $item." ": "&nbsp;");
       
  
      # $order_id = $_POST['id_adresa'];
       $url = "http://localhost:2000/ok/api.php?id_adresa=".trim($item);
 
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
 
        $result = json_decode($response);
        array_push($pars,trim($result->domeniu));
       
        
        
       
   }
} 
$domain = array_unique($pars);

foreach ($domain as $i){
    echo '<div class="topleft">';
    echo "<table class='minimalistBlack'>";
    echo "<thead>
    <tr><th>Domeniu:$i</th></tr></thead>
    <tbody>";
#echo "#".$i."#";
$sti = oci_parse($conn, "SELECT titlu||'#'||link_site FROM adresa where domeniu='$i'");
oci_execute($sti);
while ($row = oci_fetch_array($sti, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        $user= (explode("#",$item));
        $bd_titlu=$user[0];
        $bd_link=$user[1];
        #echo ($item !== null ? $bd_titlu." ".$bd_link."#": "&nbsp;");
        echo "<tr><td><a href=$bd_link> $bd_titlu</a></td></tr>";
    }
 } echo "</tbody></table></br>";
 echo "</div>";

}
 
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
                <label>Link address</label>
                <input type="text" name="k_link" class="form-control" value="<?php echo $k_link; ?>">
                <span class="help-block"><?php echo $k_link_err; ?></span>
            </div> 

       
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
<?php
echo '[id-ul tau este '.$_SESSION["id"].']';

if($_SESSION["name"]) {
?>
Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.</a>
</br>Click here to <a href="feed.php" tite="Feed">Feeds.</a>
<?php
}else echo "<h1>Please login first .</h1>";
?>
  
   
  </div>
  </div>
  <div class="selector">
    
  </div>
    
    
</body>

</html>