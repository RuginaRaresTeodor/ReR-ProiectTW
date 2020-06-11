<?php
header("Content-Type:application/json");
if (isset($_GET['id_adresa']) && $_GET['id_adresa']!="") {
 include('config.php');
 $user_id = $_GET['id_adresa'];
 
 $result = oci_parse(
 $link,"SELECT * FROM adresa WHERE id_adresa=$user_id");

oci_execute($result);
$stack = array();
$null=array();
 while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
    
        array_push($stack,$item);
        
    }
 }
 if($stack!=$null) {
 $id_adresa = $stack[0];
 $titlu = $stack[1];
 $domeniu = $stack[2];
 $link = $stack[3];
 response($id_adresa, $titlu,$domeniu, $link);
 }else{
 response(NULL, NULL, 200,"No Record Found");
 }
}else{
 response(NULL, NULL, 400,"Invalid Request");
 }
 
function response($id_adresa, $titlu,$domeniu, $link){
 $response['id_adresa'] = $id_adresa;
 $response['titlu'] = $titlu;
 $response['domeniu'] = $domeniu;
 $response['link'] = $link;
 
 $json_response = json_encode($response);
 echo $json_response;
}
?>