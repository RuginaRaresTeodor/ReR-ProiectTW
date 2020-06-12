// document.addEventListener('DOMContentLoaded', function() {
//   var checkPageButton = document.getElementById('checkPage');
//   checkPageButton.addEventListener('click', function() {

//     chrome.tabs.getSelected(null, function(tab) {
//       d = document;

//       var f = d.createElement('form');
//       f.action = 'http://gtmetrix.com/analyze.html?bm';
//       f.method = 'post';
//       var i = d.createElement('input');
//       i.type = 'hidden';
//       i.name = 'url';
//       i.value = tab.url;
//       f.appendChild(i);
//       d.body.appendChild(f);
//       f.submit();
//     });
//   }, false);
// }, false);
chrome.browserAction.onClicked.addListener(function(activeTab)
{
    var newURL = "http://www.youtube.com/watch?v=oHg5SJYRHA0";
    chrome.tabs.create({ url: newURL });
});
window.open("http://localhost/rares/feed.php",'_blank');