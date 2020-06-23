

<?php
$xml = new XMLWriter();
$xml->openUri('ourRSS.xml');
$xml->startDocument('1.0', 'utf-8');
$xml->startElement('rss');
$xml->writeAttribute('version', '2.0');
$xml->startElement('channel');
$xml->writeElement('title','recon');
$xml->writeElement('link','http://localhost:2000/new/index.php');
$xml->writeElement('description','Toate feed-urile preferate intr-un singur loc');
$xml->startElement('pubDate');
$xml->writeCdata(date("Y-m-d h:i:sa"));
$xml->endElement();
add_img('profile.png','recon','index.php',$xml);


function add_img($url,$title,$link){
    $GLOBALS["xml"]->startElement('image');
    $GLOBALS["xml"]->writeElement('url',$url);
    $GLOBALS["xml"]->writeElement('title',$title);
    $GLOBALS["xml"]->writeElement('link',$link);
    $GLOBALS["xml"]->endElement();

}
function add_item($title,$link,$descr,$Eurl,$Ei,$Etype,$dte,$cat){
    $GLOBALS["xml"]->startElement('item');
    $GLOBALS["xml"]->writeElement('title',$title);
    $GLOBALS["xml"]->writeElement('link',$link);

    $GLOBALS["xml"]->startElement('description');
    $GLOBALS["xml"]->writeCdata($descr);
    $GLOBALS["xml"]->endElement();

    $GLOBALS["xml"]->startElement('enclosure');
    $GLOBALS["xml"]->writeAttribute('url', $Eurl);
    $GLOBALS["xml"]->writeAttribute('length', $Ei);
    $GLOBALS["xml"]->writeAttribute('type', $Etype);
    $GLOBALS["xml"]->endElement();

    $GLOBALS["xml"]->writeElement('pubDate',$dte);
    $GLOBALS["xml"]->startElement('category');
    $GLOBALS["xml"]->writeCdata($cat);
    $GLOBALS["xml"]->endElement();

    $GLOBALS["xml"]->endElement();

}
function open_XML($xml22){
$xml2=simplexml_load_file($xml22) or die("Error: Cannot create object");



foreach($xml2->children() as $channel){
 
  

  echo $channel->title;
  $max7=0;
  foreach($channel->item as $item){ 
      $max7++;
      if($max7<13){  
      $t=$item->title;
      $l=$item->link;
      $d=$item->description;
      $p=$item->pubDate;
      $c=$item->category;
      $u=$item->enclosure['url'];
      $y=$item->enclosure['type'];
      $e=$item->enclosure['length'];
    add_item($t,$l,$d,$u,$e,$y,$p,$c);}

  }

  }
 

}?>

  <?php
 require_once "config.php";
 $stid = oci_parse($link, "SELECT * FROM feeds order by address desc");
 oci_execute($stid);
 while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        //echo $item." \n  ";
       open_XML($item);
    }}
    $xml->endElement();
    $xml->endElement();

?>