if ( typeof(Xataface)=='undefined' ) Xataface={};
Xataface.showEmailAddresses = function(){
	var url = DATAFACE_SITE_HREF;
	var data = window.location.search;
	data = data.replace(/-action=[^&]*/, '')+'&-action=get_email_addresses';
	getDataReturnText(url+data, function(text){
		document.getElementById('email-addresses').innerHTML = '<textarea rows="10" cols="60">'+text+'</textarea>';
	});
	
	
};