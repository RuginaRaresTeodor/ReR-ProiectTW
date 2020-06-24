function ajax_add_feed_to_user(a,b) {

	var ajaxRequest;  // The variable that makes Ajax possible!
            
	try {        
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	} catch (e) {
	   
	   // Internet Explorer Browsers
	   try {
		  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   } catch (e) {
		  
		  try {
			 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (e) {
			 // Something went wrong
			 alert("Your browser broke!");
			 return false;
		  }
	   }
	}
	
   
	var queryString = "?id=" + a ;
	
	queryString +=  "&site=" + b;
	ajaxRequest.open("POST", "http://localhost:2000/new/save.php" + queryString, true);
	ajaxRequest.send(null); 
 }