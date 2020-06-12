google.load("feeds", "1");
var k=1;

function initialize(address) {
  var feed = new google.feeds.Feed(address);

//var feed = new google.feeds.Feed("https://stirileprotv.ro/rss");
feed.load(function(result) {
if (!result.error) {
var container = document.getElementById("dut");
var table = document.createElement('table');
var b = document.createElement('br');
container.appendChild(b);
table.className="gogu";
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
        var text = document.createElement('h3');
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