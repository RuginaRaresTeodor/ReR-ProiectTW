<?php
header("Content-Type:application/json");

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