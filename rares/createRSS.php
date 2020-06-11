<html>
  <head>
  
    <script type="text/javascript" src="json/gfapi.js"></script>

    <script type="text/javascript">

    google.load("feeds", "1");
    
    
    function initialize(address) {
      var feed = new google.feeds.Feed(address);

      //var feed = new google.feeds.Feed("https://stirileprotv.ro/rss");
      feed.load(function(result) {
        if (!result.error) {
          var container = document.getElementById("feed");
          for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            //var div = document.createElement("div");
           
            // div.appendChild(document.createTextNode(entry.title));
            //div.appendChild(document.createTextNode(entry.link));
           
            var descriere=entry.content;
            var data_publicarii=entry.publishedDate;
            var categorie=entry.categories;//cel mai bn de ales
            var titlu=entry.title;
            var llink=entry.link;

            //array_push($S_descriere,$id);
            
            //container.appendChild(div);

            var newBaitTag = document.createElement('a');
            var b = document.createElement('br');
            var newBaitText = document.createTextNode(titlu);
            newBaitTag.setAttribute('href', entry.link);
   
            newBaitTag.appendChild(newBaitText);
            container.appendChild(newBaitTag); 
            container.appendChild(b); 

              
          }
        }
      });
    }

    
    function start(address){
     google.setOnLoadCallback(initialize(address));

    }
    //start("https://stirileprotv.ro/rss");
    </script>
    
       <?php
       require_once "config.php";

       $stid = oci_parse($link, "SELECT * FROM feeds");
       oci_execute($stid);
       while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          foreach ($row as $item) {
              //echo $item." \n  ";
              $g="start("."'$item'".")";
              echo '<script type="text/javascript">'.$g.';</script>';
              //echo '<script type="text/javascript">addTable();</script>';

          }}
         

?>
  </head>
  <body>
  <table id="myTable" cellpadding="2" cellspacing="2" border="1" onclick="tester()"></table>
        <script>
         var feed = new google.feeds.Feed("https://stirileprotv.ro/rss");

//var feed = new google.feeds.Feed("https://stirileprotv.ro/rss");
feed.load(function(result) {
  if (!result.error) {
    
    for (var i = 0; i < result.feed.entries.length; i++) {
      var entry = result.feed.entries[i];
            var student;
            
                student = {
                    name: entry.publishedDate,
                    rank: entry.title,
                    stuclass:entry.categories,
                };
                var table = document.getElementById("myTable");
                var row = table.insertRow(i);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                
                cell1.innerHTML = student.name,
                cell2.innerHTML = '<a href="'+entry.link+'">'+entry.categories+'</a>',
                cell3.innerHTML = student.rank;
              
        }
      
            }});
        </script>
    <div id="feed"></div>
  </body>
</html>