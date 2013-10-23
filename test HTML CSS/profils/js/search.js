// JavaScript Document

$(document).ready(function(e) {
    $("#recherche").keyup(function(){
		var recherche=$(this).val();
		var data='motclef='+recherche;
		
		if(recherche.length>1){
			
			$.ajax({
				type : "GET",
				url : "chercher.php",
				data : data,
				success: function(server_response){
					
					$("#resultat").html(server_response).show();
				}
			});
		}
		
		else if(recherche.length<2){
			$("#resultat").hide();
		}
	
	
	
	
	});






});