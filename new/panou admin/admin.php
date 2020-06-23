<link rel="stylesheet" type="text/css" href="tabel.css">

<?php
require_once "config.php";
echo '<div class="topleft">';
echo "<table class='minimalistBlack'>";
echo "<thead><tr><th>id</th><th>nume</th><th>mail</th><th>parola</th><th></th><th></th></tr></thead><tbody>";
$stid = oci_parse($link, "SELECT nume FROM userr");
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
   foreach ($row as $item) {
    $url = "http://localhost:2000/new/apiUser.php?id_adresa='".trim($item)."'";

 
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
$result = json_decode($response);

$numm=trim($result->nume);
$mmail=trim($result->adresa_mail);
$pass=trim($result->parola);
$id=trim($result->id_user);


echo '<form action="modify.php" method="post">
          <tr><td>'.$id.'</td>
          <input type="hidden" name="id" value="'.$id.'">  
          <td><input type="text" name="nume" value="'.$numm.'"></td>  
          <td><input type="text" name="mail" value="'.$mmail.'"></td>
          <td><input type="text" name="pass" value="'.$pass.'"></td>
          <td><input type="submit" class="btn btn-primary" value="Modify"></td>
          <td><a href="deleteU.php?id='.$id.'">Delete</a></td>
</tr></form>';
   }
   
} 
echo ' 
   <form action="add.php" method="post">
   <tr><td>'.(intval($id)+1).'</td>
   <input type="hidden" name="id" value="'.(intval($id)+1).'">  
   <td><input type="text" name="nume" value=""></td>  
   <td><input type="text" name="mail" value=""></td>
   <td><input type="text" name="pass" value=""></td>
   <td><input type="submit" class="btn btn-primary" value="+"></td>
   <td><a href=""></a></td>';

echo "</tbody></table></br>";
echo "</div>";



  
?>