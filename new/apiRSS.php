<?php
header("Content-Type:application/json");
if (isset($_GET['id_user']) && $_GET['id_user']!="") {
    include('config.php');
    $user_id = $_GET['id_user'];
    
    $result = oci_parse(
    $link,"SELECT feed_site FROM link_feed WHERE user_id=$user_id");
   
   oci_execute($result);
   $stack = array();
   $null=array();
    while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) {
       foreach ($row as $item) {
       
           array_push($stack,$item);
           
       }
    }
    $i=1;
    $response=array();
 if($stack!=$null) {
    foreach ($stack as $l) {

 $link = $l;
 $i=$i+1;
 $n="id".$i;
 $response[$n] = $link;
 }response($response);
 }else{
 response(NULL, NULL, 200,"No Record Found");
 }
}else{
 response(NULL, NULL, 400,"Invalid Request");
 }
function response($response){

$json_response = json_encode($response);
echo $json_response;
}

?>