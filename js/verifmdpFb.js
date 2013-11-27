// JavaScript Document

$(document).ready(function(e) {
var mdpFb=false;
var pseudoFreeFb=false;

    $("#retape_mdpFb").keyup(function(){
		var retape=$(this).val();
		
		if(retape.length>1){
			
					if($("#retape_mdpFb").val()==$("#mdpFb").val()){
						$("#imgVerifFb").attr("src","imgs/check.png");
						mdpFb=true;
					}
					else{
						$("#imgVerifFb").attr("src","imgs/fail.png");
						mdpFb=false;
					}

		}
		
	});
	
	$("#pseudoFb").keyup(function(){
		var pseudo=$(this).val();
		var data='test_pseudo='+pseudo;
		
		if(pseudo.length>2){
			
			$.ajax({
				type : "GET",
				url : "facebook_connect.php",
				data : data,
				success: function(server_response){
					
					if(server_response==0){
						$("#imgVerifPseudoFb").attr("src","imgs/check.png");
						pseudoFreeFb=true;
					}
					else{
						$("#imgVerifPseudoFb").attr("src","imgs/fail.png");
						pseudoFreeFb=false;
					}
				}
			});
		}
		else{
			$("#imgVerifPseudoFb").attr("src","imgs/fail.png");
			pseudoFreeFb=false;
			
		}
		
		
		
	
	});
	
	function disab(){
		 	if(mdpFb==true && pseudoFreeFb==true)
				$("#envoieFb").attr("disabled",false);
			else
				$("#envoieFb").attr("disabled",true);
				
				console.log($("#envoieFb").attr("disabled"));
		
		
	};

	
		$("#formInsc").keyup(function(e) {disab()});
		$("#formInsc").click(function(e) {disab()});
		
	
	







});