
<html>
<link rel="stylesheet" type="text/css" href="tabel.css">
  <head>
    <style>
      body{
        background-color:#5E60CE;
        padding-top:20px;
        padding-left:20px;
        -webkit-column-count: 2;
         -moz-column-count: 2;
         column-count: 2;
      }
      table{
        break-inside: avoid;
        color:  #FFFBFA;
        border-bottom: 1px solid #ddd;
      }
      a {
        color:  #FFFBFA;
      }
      .dw h3 { text-align: center;
      width:100%;}
       td:hover {
  background-color: white;
  -webkit-transition : all 0.5s ease-in-out ;
  -moz-transition : all 0.5s ease-in-out ;
  transition : all 0.5s ease-in-out ;
  letter-spacing: 2px;
}
 td:hover > a {
  color: black;
  -webkit-transition : all 0.2s ease-in-out ;
  -moz-transition : all 0.2s ease-in-out ;
  transition : all 0.2s ease-in-out ;
  letter-spacing: 2px;
  animation-name: da;
  animation-duration: 3s;
}

  body .nav {
    height:20%;
    width:100%;
    background-color:white;
    position:fixed;
  }
    </style>
    <script type="text/javascript" src="json/gfapi.js"></script>

    <script type="text/javascript">

    google.load("feeds", "1");
    var k=1;
    
    function initialize(address) {
      var feed = new google.feeds.Feed(address);

//var feed = new google.feeds.Feed("https://stirileprotv.ro/rss");
feed.load(function(result) {
  if (!result.error) {
    var container = document.getElementById("feed");
    var table = document.createElement('table');
    var b = document.createElement('br');
    container.appendChild(b);
    
    var hh=0;
    for (var i = 0; i < result.feed.entries.length; i++) {
      var entry = result.feed.entries[i];
            var student;
            
                student = {
                    name: entry.publishedDate,
                    rank: entry.title,
                    stuclass:entry.categories,
                };
                
               
               
                if (hh==0){
            var text = document.createElement('a');
            var newBaitText = document.createTextNode(entry.categories);
            text.appendChild(newBaitText);
            container.appendChild(text); 
            container.appendChild(b);
            
                }

                var row = table.insertRow(hh);
                hh=hh+1;
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                
                cell1.innerHTML = student.name,
                cell2.innerHTML = '<a href="'+entry.link+'">'+entry.title+'</a>',
                //cell3.innerHTML = student.rank;
                container.appendChild(table); 
                container.appendChild(b);
        }
      
            }});
    }

    
    function start(address){
     google.setOnLoadCallback(initialize(address));

    }
    //start("https://stirileprotv.ro/rss");
    </script>
    
    
  </head>
  <body>
  
        <script>
           <?php
       require_once "config.php";

       $stid = oci_parse($link, "SELECT * FROM feeds");
       oci_execute($stid);
       while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          foreach ($row as $item) {
              //echo $item." \n  ";
              $g="start("."'$item'".")";
              echo '<script type="text/javascript">'.$g.';</script>';

          }}
         

?>
    
        </script>
        <h1 style="align-self:center; font-size: 40; color:white;">Your Feed<h1>
    <div id="feed"></div>
</form>
  </body>
</html>