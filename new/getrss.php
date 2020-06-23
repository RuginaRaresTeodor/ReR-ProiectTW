


<?php

//get the q parameter from URL
/*$q=$_GET["q"];

//find out which feed was selected
if($q=="Google") {
  $xml=("https://stirileprotv.ro/rss");
} elseif($q=="ZDN") {
  $xml=("https://www.zdnet.com/news/rss.xml");
}
*/
$xml=$_GET["l"];
$xml2=simplexml_load_file($xml) or die("Error: Cannot create object");
foreach($xml2->children() as $channel){
//get elements from "<channel>"
$channel_title = $channel->title;
$channel_link = $channel->link;
$channel_desc = $channel->description;
$channel_pubdate=$channel->pubDate;


//output elements from "<channel>"
echo("<p>[".$channel_pubdate."]<a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");

//get and output "<item>" elements
foreach($channel->item as $item){

$item_title = $item->title;
$item_link = $item->link;
$item_desc = $item->description;
$item_pubdate=$item->pubDate;

$video_url=$item->enclosure['url'] ;
$video_type=$item->enclosure['type'] ;//video

if($video_url!=''){
  if($video_type!="image/jpeg"){
echo '<video controls> 
  <source src="'.$video_url.'" type="'.$video_type.'">
</video>';}
else{///video

  echo "<p>
 <a href='".$item_link."'>
<img alt='".$item_title."'
 src='".$video_url."'
   ></a></p>";//image 1/2
}


  }
$Atime=array("year","month","day","hour","min");
$date = date('m/d/Y H:i', time()+3600);
$date2 = strtotime($item_pubdate);
$date2 = date('m/d/Y H:i', $date2+3600);
$datetime1 = new DateTime($date);
$datetime2 = new DateTime($date2);
$interval = $datetime2->diff($datetime1);
$Atime["day"]=$interval->format('%d');
$Atime["hour"]=$interval->format('%H');
$Atime["min"]=$interval->format('%i');
$Atime["month"]=$interval->format('%m');
$Atime["year"]=$interval->format('%Y');





echo ("<br>");
echo "timp trecut".$interval->format('%m#%d#%Y-%H:%i');
echo ("<br>");
echo "A: " . $date;
echo ("<br>");
echo "Data: " . $date2;
echo ("<br>");

  echo ("<p>[".$item_pubdate."]<a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>"); 
}


foreach($channel->image as $image){
  $image_title=$image->title;
  $image_link=$image->link;
  $image_url=$image->url;

  $image_width=$image->width;
  $image_height=$image->height;

  echo "<p>
 <a href='".$image_link."'>
<img alt='".$image_title."'
 src='".$image_url."'
  width='".$image_width."'
   height='".$image_height."'
   ></a></p>";

}
}

