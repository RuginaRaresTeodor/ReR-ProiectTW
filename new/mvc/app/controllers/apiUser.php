<?php
header("Content-Type:application/json");
if (isset($_GET['id_adresa']) && $_GET['id_adresa']!="") {
 include('config.php');
 $user_id = $_GET['id_adresa'];
 
 $result = oci_parse(
 $link,"SELECT * FROM userr WHERE nume=$user_id or adresa_mail=$user_id");

oci_execute($result);
$stack = array();
$null=array();
 while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
    
        array_push($stack,$item);
        
    }
 }
 if($stack!=$null) {
 $id_user = $stack[0];
 $nume = $stack[1];
 $parola = $stack[2];
 $adresa_mail = $stack[3];
 response($id_user, $nume,$parola, $adresa_mail);
 }else{
 response(NULL, NULL, 200,"No Record Found");
 }
}else{
 response(NULL, NULL, 400,"Invalid Request");
 }
 
function response($id_user, $nume,$parola, $adresa_mail){
 $response['id_user'] = $id_user;
 $response['nume'] = $nume;
 $response['parola'] = $parola;
 $response['adresa_mail'] = $adresa_mail;
 
 $json_response = json_encode($response);
 echo $json_response;
}
?>