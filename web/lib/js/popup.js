
function buttonEvents(){
	/*Show notification box*/
	$("#clickme").click(function(){
		$("#screen").css({"visibility":"visible","opacity":".7"});
		$("#notification").css({"visibility":"visible","opacity":"0.9","width":"300px", "height":"150px"});
		$("#content").css({"height":"90%", "width":"100%"});

	});

	/*Close notification*/
	$("#close").click(function(){
		$("#screen").css({"opacity":"0","visibility":"hidden"});
		$("#notification").css({"height":"30%", "width":"100%","opacity":"0","visibility":"hidden"});
		$("#content").css({"height":"100%", "width":"100%","border-radius":"none"});
	});

	/*Close when user clicks outside of notification box*/
	$("#screen").click(function(){
		$("#screen").css({"opacity":"0","visibility":"hidden"});
		$("#notification").css({"height":"30%", "width":"100%","opacity":"0","visibility":"hidden"});
		$("#content").css({"height":"100%", "width":"100%","border-radius":"none"});
	});
}

if(window.attachEvent){window.attachEvent('onload', buttonEvents);}
else if(window.addEventListener){window.addEventListener('load', buttonEvents, false);}
else{document.addEventListener('load', buttonEvents, false);}
