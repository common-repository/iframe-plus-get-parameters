/*
 # Written 2022-2023
 #	 by Jeffrey Quade 
**/

(function () {
	var oldonload = window.onload;
	window.onload = function(){

		// Begin Script
		var iframe = document.getElementById('myIframe');
		// Leave width alone. Easy to set in other places.
		if (0) iframe.width = iframe.contentWindow.document.body.scrollWidth;  
		iframe.height = iframe.contentWindow.document.body.scrollHeight;
		if (0) alert('h: '+iframe.height); 
		jQuery('iframe').css('height', iframe.height);

		// End Script
		if (oldonload) { oldonload()}
	};
}());
