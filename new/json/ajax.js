function ajax_add_feed_to_user(a,b) {

		
		if(a!="" && b!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					id: a,
					site: b		
				},

				
			});
		}
}