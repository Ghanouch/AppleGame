var card = 70;
var v_vendeur = 0 ;
var v_acheteur;
var headList=[];
var user ;
var height = 0;
$(function () {

    v_vendeur = $('#sessionID').html();
    $( ".chat" ).draggable();
		getCardValue("vendeur");
		$('.validate').bind('click',function (event){
			$.post("lib/php/updateSlogon.php",{slogon:$('.texSlogon').val()},function(data){
				v_acheteur(data);
    		});
        });
		$.get("lib/php/getContacts.php",{type:"acheteur"},function(data){
				var acheteur = data.split("|");
				var i=0;
				for(;i<acheteur.length-1;i++){
					$('.playersList').append("<div id='P"+acheteur[i].split("/")[1]+"'class='player' onclick ='UpdatechatHeads(this)' ><div class='img idd'>"+acheteur[i].split("/")[0].charAt(0).toUpperCase()+"</div><div class='name idd'>"+acheteur[i].split("/")[0]+"<div class='clients idd'>"+acheteur[i].split("/")[2]+"</div></div></div>");
				}
        });
        $('.player').bind('click', function (event) {
            //$('.playersList').remove('#'+this.id);
            $('.chatHeads').append("<div id='"+this.id+"' class='head idd' onclick='showChat(this)'>" +this.id+"</div>");
        });
        $('.head').bind('click', function (event) {
        	$('.chat').fadeIn();
        });
         $('.Chatmin').bind('click', function (event) {
           $('.chatBody').empty();
        	 $('.chat').toggle('blind');
           user = 0;
        });
        $('.Chatclose').bind('click', function (event) {
          $('.chatBody').empty();
          var iduser =   $('.chat').attr('id').substring(3);
          $(".playersList #P"+iduser).fadeIn();
          $(".chatHeads #CP"+iduser).fadeOut();
          $(".chatHeads #CP"+iduser).remove();
          var i=0;
          while(i<headList.length && headList[i] != iduser) i++;
          headList.splice(i,1);
          socket.emit('updateClient', { sender: "Acheteur", username: v_vendeur,count:headList.length });
          $.post("lib/php/updateClients.php",{type : "Acheteur",count: headList.length},function(data){
              //console.log(data);
          });
          //console.log(headList);
          $('.chat').toggle('explode');
          user = 0;
       });
         $('.minus').bind('click', function (event) {
        	if(card >5) card = card-5;
        	if(card == 5)$('.pricing').text("0"+card);
        	else $('.pricing').text(card);
        });
            $('.plus').bind('click', function (event) {
        	if(card < 95) card = card+5;
        	$('.pricing').text(card);
        });

             $('.validateParice').bind('click',function(event){
               console.log(parties);
            $.post("lib/php/Validate.php",{id_vendeur:v_vendeur,id_acheteur:user,Type_Joueur:'Vendeur',v_partie:parties} ,function(data)
            {
            var tab_etat = data.split("|") ;
            if(tab_etat[0] == '1')
            {
              socket.emit('send', { message: "refresh page please", username: user,sender: v_vendeur,type :$('#sessionPlayer').html()});
              var i=0;
              while(i<headList.length && headList[i] != user) i++;
              headList.splice(i,1);
              socket.emit('updateClient', { sender: "Acheteur", username: v_vendeur,count:headList.length });
              $(".playersList #P"+user).fadeIn();
              $(".chatHeads #CP"+user).fadeOut();
              $(".chatHeads #CP"+user).remove();
              getCardValue("vendeur");
              $(".chat").toggle("explode");
              $("#screen").css({"visibility":"visible","opacity":".7"});
              $("#notification").css({"visibility":"visible","opacity":"1","width":"300px", "height":"150px"});
              $("#content").css({"height":"90%", "width":"90%","border-radius":"10px"});
            }else console.log(data);
            } );

           });

             $('.suggest').bind('click',function (event){
            $.post("lib/php/suggest.php",{id_vendeur:v_vendeur,id_acheteur:user,Montant_Sugg:$('.pricing').html(),Validate_Vendeur:'1'},function(data)
        {
            var text = $('.pricing').html();
            socket.emit('send', { message: "I suggest : "+text, username: user,sender: v_vendeur,type :$('#sessionPlayer').html()});
            $('.chatBody').append("<div class='msgLeft'><div class='headChatMessage idd'>"+$('.IDimage').text()+"</div><div class='message idd'>"+ "I suggest : "+text+"</div></div>")
            height += parseInt($(".msgLeft").height());
            $('.chatBody').animate({scrollTop: height});


        })
});

             $('#click_rapport').bind('click', function (event) {
                v_acheteur("hhh");
                 $.post("../php/Jasper.php",{id_vendeur:'4'},function(data)
                 {
               $("#rapport_id").html(data);
            });
           });
           $('.micro').bind('click', function (event) {
             socket.emit('brah', { sender:$('.IDname').html(),message: $('.texSlogon').val()});
          });


});
function getCardValue(vh) {
    $.get("lib/php/getCardvalue.php",{type:"vendeur"},function(data){
        $('.cardVl').html("Your card value is "+data.split("|")[0]);
        $('.IDname').html(data.split("|")[1]);
        $('.IDimage').html(data.split("|")[1].charAt(0));
        $( ".cardVl" ).effect( "bounce" );
        if(vh == "vendeur")$('.texSlogon').val(data.split("|")[2]);
    });
}
function UpdatechatHeads(item) {
    var id = "#"+$(item).attr("id");
    headList.push(id.substring(2));
    $.post("lib/php/updateClients.php",{type : "Vendeur",count: headList.length},function(data){
        //console.log(data);
    });
    socket.emit('updateClient', { sender: "Acheteur", username: v_vendeur,count:headList.length });
    $(id).fadeOut();
    $('.Chatname').html($("#P"+id.substring(2)).text().substring(1));
    $('.chatHeads').append("<div style='display:none' id='C"+$(item).attr("id")+"' class='head idd' onclick='showChat(this)'>" +$(item).text().charAt(0)+"</div>");
    id = '#C'+$(item).attr("id");
    $('.chatHeads '+id).fadeIn();
}
function showChat(item) {
    $(".chatHeads #"+$(item).attr("id")).animate({
      backgroundColor : "#eca941"
    });
    $('.chat').attr('id', "C"+$(item).attr("id"));
    $('.chatBody').empty();
    user = $('.chat').attr("id");
    user = " " + user + "";
    user = user.substring(4);
    $('.Chatname').html($('#P'+user+" .name").text().substring(0,$('#P'+user+" .name").text().length-1));
    getConvo(user,"vendeur");
    $('.chat').fadeIn();
}
function getConvo(user,type){
  $.get("lib/php/getConversation.php",{myid : $('#sessionID').html(),otherid:user,type:type},function(data){
      var tab = data.split("|");
      for (var i = 0; i < tab.length-1; i++) {
            var cla;
            var nn;
            if(tab[i].split("@")[0] == "you") {
              cla = "msgLeft";
              nn = $('.IDimage').text();
              }
            else{
               cla = "msgRight";
               nn = $('#P'+user+" .img").text();
             }
            $('.chatBody').append("<div class='"+cla+"'><div class='headChatMessage idd'>"+nn+"</div><div class='message idd'>"+tab[i].split("@")[1]+"</div></div>");
            height += parseInt($("."+cla).height());
      }
      $('.chatBody').animate({scrollTop: height});
  });
}
function closeChat(item) {
    $('.chatBody').html("");
    $('.chat').fadeOut();
}
