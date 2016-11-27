////////////////// Customization //////////////////

// Google-Maps

gm_address = "St Elisabeth Street, Melbourne, Australia";


////////////////// Customization End //////////////////

$(document).ready(function() {

	// The navigation menu

	
	// onload animation

	setTimeout(function() {
		// get elements
		innerBar = $(".inner-bar");

		if($.browser.msie) {
			// do nothing
		} 
		else {
			// get length of innerbar
			for (i=0; i <= innerBar.length-1; i++) {
				innerBarStyle = innerBar.eq(i).attr("style");
				splitString = innerBarStyle.split(" ");
					// check if skill percentage has 2 or 3 characters
					if (splitString[1].length == 3) {
						innerBarWidth = splitString[1].substring(0,2);
					}	
					else {
						innerBarWidth = splitString[1].substring(0,3);
					}
				innerBar.eq(i).show().css({width:"1%"}).animate({"width":innerBarWidth+"%"},1000);
			}
		}
	},750);

	// fancybox for img

	

	// validation



});
