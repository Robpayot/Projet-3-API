// JavaScript Document

$(document).ready(function(e) {
    $("#retape_mdp").keyup(function(){
		var retape=$(this).val();
		var message;

		
		if(retape.length>1){
			
					if($("#retape_mdp").val()==$("#mdp").val()){
						message="bon";
					}
					else
						message="mauvais";
						
					$("#verifMatchMdp").html(message).show();

		}
		
		else if(retape.length<2){
			$("#verifMatchMdp").hide();
		}
		
		
		
	$(document).keyup(function(e) {
        if(message=="bon" && $("#niveau").val()!="niveaux"
			)
			$("#envoie").attr("disabled",false);
		else
			$("#envoie").attr("disabled",true);
    });
	
		$(document).click(function(e) {
        if(message=="bon" && $("#niveau").val()!="niveaux"
			)
			$("#envoie").attr("disabled",false);
		else
			$("#envoie").attr("disabled",true);
    });
	
	
	
	
	});






});