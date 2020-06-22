
<?php


function news($block){
  //echo "am ajuns aici";  
echo "
<script>
 a=document.createElement('a');
a.target='_blank';
a.href='".$block["link"]."';
//then use this code for alert
if (window.confirm('".$block["description"]."'))
{
a.click();
};
</script>";

}

?>

<?php
//get the q parameter from URL
function news_from_xml($xml){


$xml2=simplexml_load_file($xml) or die("Error: Cannot create object");

foreach($xml2->children() as $channel){


//get and output "<item>" elements
foreach($channel->item as $item){

$item_link2 = $item->link;
$item_desc2 = $item->description;
$item_pubdate2=$item->pubDate;


$Atime=array("year","month","day","hour","min");
$date = date('m/d/Y H:i', time()+3600);
$date2 = strtotime($item_pubdate2);
$date2 = date('m/d/Y H:i', $date2+3600);
$datetime1 = new DateTime($date);
$datetime2 = new DateTime($date2);
$interval = $datetime2->diff($datetime1);
$Atime["day"]=$interval->format('%d');
$Atime["hour"]=$interval->format('%H');
$Atime["min"]=$interval->format('%i');
$Atime["month"]=$interval->format('%m');
$Atime["year"]=$interval->format('%Y');

if($Atime["month"]==0 and $Atime["year"]==0 and $Atime["day"]==0 and $Atime["hour"]==0 and ($Atime["min"]==1)){

$ff=array("link","description");
$ff["link"]=$item_link2;
$ff["description"]=$item_desc2;

    //echo "############################";////APEL POP UP
    news($ff);




}
}
}

}

?>
<?php
session_start();


$url = "http://localhost:2000/rares/apiRSS.php?id_user=".$_SESSION["id"];
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
$result = json_decode($response);
if(!empty($result))
foreach ($result as $l)
news_from_xml($l);

?>
