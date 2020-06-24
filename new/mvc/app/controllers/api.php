<?php
header("Content-Type:application/json");
if (isset($_GET['link_site']) && $_GET['link_site']!="") {
 include('config.php');
 $adresa_link = $_GET['link_site'];
 $result = oci_parse(
 $link,"SELECT * FROM adresa WHERE link_site='".$adresa_link."'");

oci_execute($result);
$stack = array();
$null=array();
 while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
    
        array_push($stack,$item);
        
    }
 }
 if($stack!=$null) {
 $id = $stack[0];
 $titlu = $stack[1];
 $domeniu = $stack[2];
 $link = $stack[3];
 response($id, $titlu,$domeniu, $link);
 }else{
 response(NULL, NULL, 200,"No Record Found");
 }
}else{
 response(NULL, NULL, 400,"Invalid Request");
 }
 
function response($id, $titlu,$domeniu, $link){
 $response['id'] = $id;
 $response['titlu'] = $titlu;
 $response['domeniu'] = $domeniu;
 $response['link'] = $link;
 
 $json_response = json_encode($response);
 echo $json_response;
}
?>