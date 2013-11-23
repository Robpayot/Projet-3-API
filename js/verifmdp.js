// JavaScript Document

$(document).ready(function(e) {
var mdp=false;

    $("#retape_mdp").keyup(function(){
		var retape=$(this).val();
		
		if(retape.length>1){
			
					if($("#retape_mdp").val()==$("#mdp").val()){
						$("#imgVerif").attr("src","imgs/check.png");
						mdp=true;
					}
					else{
						$("#imgVerif").attr("src","imgs/fail.png");
						mdp=false;
					}

		}
		
	});

	
		$("#envoie").click(function(e) {
 			if($("#nom").val().length<4 || $("#prenom").val().length<4 || $("#email").val().length<4 ||mdp==false)
				$("#envoie").attr("disabled",true);
			else
				$("#envoie").attr("disabled",false);
				
				console.log($("#envoie").attr("disabled"));
	
		});
	
	







});