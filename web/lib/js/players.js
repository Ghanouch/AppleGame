var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'sounds/newPlayer.wav');
var players;
getNewPlayers();
window.setInterval(function(){
	updatePlayers();
},3000);
function updatePlayers() {
   	$.ajax({
	    type: 'GET',
	     url: 'lib/php/countPlayers.php',
	    data: $('form').serialize(),
	    success: function (data) {
	    	if(players != parseInt(data)){
	    		if(players != null) audioElement.play();
	    		players = parseInt(data);
	    		getNewPlayers();
	    	}
	    }
	});
}
function getNewPlayers(){
	$.ajax({
	    type: 'GET',
	    url: 'lib/php/getAllPlayers.php',
	    data: $('form').serialize(),
	    success: function (data) {
	    	$('#seller').empty();
	    	$('#buyer').empty();
	    	var buyers = data.split("|")[1].split("-");
	    	var sellers = data.split("|")[0].split("-");
				var typev="vendeur";
				var typea="acheteur";
	    	for( i=0;i<sellers.length-1;i++){
					var id_acheteur = sellers[i].split("_")[0];
					var Nom = sellers[i].split("_")[1];
	    		$('#seller').append("<div class='tableRowName'><a href='lib/php/Jasper.php?page_name="+typev+"&id_player="+id_acheteur+"'>"+Nom+"</a></div>");
	    	}
	    	for( i=0;i<buyers.length-1;i++){
					var id_vendeur = buyers[i].split("_")[0];
					var Nom = buyers[i].split("_")[1];
	    		$('#buyer').append("<div class='tableRowName'><a href='lib/php/Jasper.php?page_name="+typea+"&id_player="+id_vendeur+"'>"+Nom+"</a></div>");
	    	}
	    	$("#buyerheader").html(buyers.length-1+" Buyers");
	    	$("#sellerheader").html(sellers.length-1+" Sellers");
	    }
	});
}
