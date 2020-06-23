<html >
<head >
<title>Recon</title>
  <meta name="description" content="We recon for you!">
  <meta name="author" content="Rares Rugina & Marius Roman">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="profile.png" />
  <link rel="stylesheet" type="text/css" href="css/tabel.css">
  <link rel="stylesheet" href="css/pagina.css" type="text/css" media="screen" />

  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body id="home">


<?php 
function media($tip,$url,$w,$h,$i,$c)
{
  if($url=='')$url="img/default.jpg";

  if($tip!="image/jpeg" && $tip!=""){
echo '<video width="'.$w.'" height="'.$h.'" id="'.$i.'" class="'.$c.'" controls> <source src="'.$url.'" type="'.$tip.'"></video>';
                        }
else{

  echo '<img src="'.$url.'" alt="" width="'.$w.'" height="'.$h.'" id="'.$i.'" class="'.$c.'"/>';
    }

              }
              

?>
  
<?php
function open_XML($xml){
 
$xml2=simplexml_load_file($xml) or die("Error: Cannot create object");
$stiri=0;
$ittem=array(
  array('titlu'),
  array('link'),
  array('desc'),
  array('date'),
  array('img'),
  array('type')
);
foreach($xml2->children() as $channel){
  $channel_title = $channel->title;
  $channel_link  = $channel->link;

  echo '</br><h3> <a href="'.$channel_link.'">'.$channel_title.'</a><br />';
  foreach($channel->item as $item){


$ittem['titlu'][]=$item->title;
$ittem['link'][]=$item->link;
$ittem['desc'][]=$item->description;
$ittem['date'][]=$item->pubDate;
$ittem['img'][]=$item->enclosure['url'];
$ittem['type'][]=$item->enclosure['type'];

  }}
  echo ' <div id="homecontent-top">
    <div id="homecontent-topleft" class="left">
      <div id="leadcontainer" style="
      padding-bottom: 95px;
      width: 510px;
      ">
          <ul>
            <div id="leadheader">
           

  <h3> <a href="'.$ittem["link"][0].'">News</a><br />
              </h3>
             
              <span class="leadmeta">'.
              $ittem["date"][0].' </span> <a href="'.$ittem["link"][0].'" class="title">'. $ittem["titlu"][0].' </a> </div>
            <a href="'.$ittem["link"][0].'">';media($ittem["type"][0],$ittem["img"][0],350,300,"leadpic","");
            echo '</a>
            <p>'.$ittem["desc"][0].'</p>
            <div class="read-on"> <a href="'.$ittem["link"][0].'"> [ Continue reading... ] </a> </div>
       
       
        </div>
      </div>
      <div id="homebottom" style="height: 10px;"></div>
    </div>
  
    <div id="homecontent-topright" class="right" >
    <div id="hometop-rightcol">
   <div class="feature"> <a href="'.$ittem["link"][1].'">';media($ittem["type"][1],$ittem["img"][1],258,133,"","");
   echo '</a> <a href="'.$ittem["link"][1].'" class="title"> '. $ittem["titlu"][1].' </a> </div>
    <div class="feature"> <a href="'.$ittem["link"][2].'">';media($ittem["type"][2],$ittem["img"][2],258,133,"","");
    echo '</a> <a href="'.$ittem["link"][2].'" class="title"> '. $ittem["titlu"][2].' </a> </div>
     <div class="feature"> <a href="'.$ittem["link"][3].'">';media($ittem["type"][3],$ittem["img"][3],258,133,"","");
     echo '</a> <a href="'.$ittem["link"][3].'" class="title"> '. $ittem["titlu"][3].'</a> </div>
     <div class="feature"> <a href="'.$ittem["link"][4].'">';media($ittem["type"][4],$ittem["img"][4],258,133,"","");
     echo '</a> <a href="'.$ittem["link"][4].'" class="title"> '. $ittem["titlu"][4].' </a> </div>
     <div class="feature"> <a href="'.$ittem["link"][5].'">';media($ittem["type"][5],$ittem["img"][5],258,133,"","");
     echo '</a> <a href="'.$ittem["link"][5].'" class="title"> '. $ittem["titlu"][5].'</a> </div>
     <div class="feature"> <a href="'.$ittem["link"][6].'">';media($ittem["type"][6],$ittem["img"][6],258,133,"","");
     echo '</a> <a href="'.$ittem["link"][6].'" class="title"> '. $ittem["titlu"][6].'</a> </div>

     </div>
  </div>
</div>


      
<div class="clear"></div>
<hr />
<hr />

<div id="homecontent-bottom">
  <div id="homeleftcol">
    <div class="clearfloat">
      <div class="cat-head">
     <h3><a href="'.$ittem["link"][7].'"> '. $ittem["titlu"][7].' </a></h3>
      </div>
      <a href="'.$ittem["link"][7].'">';media($ittem["type"][7],$ittem["img"][7],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][7].'" class="title"> About this </a><br />
      '.$ittem["desc"][7].'</div>
     
    <div class="clearfloat">
      <div class="cat-head">
     
       <h3><a href="'.$ittem["link"][8].'"> '. $ittem["titlu"][8].' </a></h3>
      </div>
      <a href="'.$ittem["link"][8].'">';media($ittem["type"][8],$ittem["img"][8],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][8].'" class="title"> About this </a><br />
      '.$ittem["desc"][8].' </div>
  </div>
  <!--END LEFTCOL-->

  <div id="homemidcol">
    <div class="clearfloat">
      <div class="cat-head">
       <h3><a href="'.$ittem["link"][9].'"> '. $ittem["titlu"][9].' </a></h3>
      </div>
      <a href="'.$ittem["link"][9].'">';media($ittem["type"][9],$ittem["img"][9],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][9].'" class="title"> About this </a><br />
      '.$ittem["desc"][9].'</div>
      
     
      <div class="clearfloat">
      <div class="cat-head">
     <h3><a href="'.$ittem["link"][10].'"> '. $ittem["titlu"][10].' </a></h3>
      </div>
      <a href="'.$ittem["link"][10].'">';media($ittem["type"][10],$ittem["img"][10],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][10].'" class="title"> About this </a><br />
      '.$ittem["desc"][10].' </div>
  </div>
  <!--END MIDCOL-->

  <div id="homerightcol">
    <div class="clearfloat">
      <div class="cat-head">
      <h3><a href="'.$ittem["link"][11].'"> '. $ittem["titlu"][11].' </a></h3>
      </div>
      <a href="'.$ittem["link"][11].'">';media($ittem["type"][11],$ittem["img"][11],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][11].'" class="title"> About this </a><br />
      '.$ittem["desc"][11].'</div>
      
     
     
      <div class="clearfloat">
      <div class="cat-head">
      <h3><a href="'.$ittem["link"][12].'"> '. $ittem["titlu"][12].' </a></h3>
      </div>
      <a href="'.$ittem["link"][12].'">';media($ittem["type"][12],$ittem["img"][12],150,100,"","home-cat-img");
      echo '</a> <a href="'.$ittem["link"][12].'" class="title"> About this </a><br />
      '.$ittem["desc"][12].'</div>
  </div>
  <!--END RIGHTCOL-->
  <!--END CONTENT-->
      
     
</div>
</div>


';}?>
<?php
 require_once "config.php";
 $stid = oci_parse($link, "SELECT * FROM feeds order by address desc");
 oci_execute($stid);
 while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        //echo $item." \n  ";
       open_XML($item);
    }}
?>
<a href="index.php" class="buton"><p>Back to Home</p></a>

</body>
</html>
