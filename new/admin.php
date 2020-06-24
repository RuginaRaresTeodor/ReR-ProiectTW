
<html>

    <head>
      <title>Recon</title>
      <meta name="description" content="Admin Panel">
      <meta name="author" content="Rares Rugina & Marius Roman">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/x-icon" href="profile.png" />
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/tabel.css">
    
      <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
      <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script src="json/fun.js"></script>
      <script type="text/javascript" src="json/gfapi.js"></script>
      <script type="text/javascript" src="json/feeds.js"></script>
      <style type="text/css">
        td
          {
           padding:0 15px;
          }
    </style>
    
    </head>
    
    <body>
   
    <?php
    
           require_once "config.php";
           $quer="SELECT * FROM feeds";
           $idx=$_SESSION["id"];
           //$quer1="SELECT feed_site FROM link_feed where user_id="."'$idx'";
           if(($aOrB)==1)$quer=$quer1;
           $stid = oci_parse($link, $quer);
           oci_execute($stid);
           while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
              foreach ($row as $item) {
                  //echo $item." ad\n  ";
                  $g="start("."'$item'".")";
                  echo '<script type="text/javascript">'.$g.';</script>';
    
              }}
             
    ?>
      <div class="nav">
        <img src="logo.svg" alt="logo">
        <div class="nav-button" id="acc" onclick="changepage1()">feed</div>
        <!-- <div class="nav-button" id="poc" ><a href="logedon.php">your place</a></div> -->
        <!-- <div class="nav-button" onclick="changefromlogin()">settings</div> -->
        <div class="nav-button" onclick="changepage3()">your place</div>
        <div class="nav-button" onclick="changepage2()">Home</div>
        <div class="menu" onclick="menufunction()">Menu</div>
        
      </div>
      <div class="full-menu">
      
    </body>
    
    </html>
    
    
    