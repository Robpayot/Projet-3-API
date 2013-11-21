// JavaScript Document
var erreur=false;
    $("#formConn").submit(function(e){
		
		e.preventDefault();
		var pseudo=$('#pseudoConnexion').val();
		
		var mdp=$("#mdpConnexion").val();
		var data='pseudo='+pseudo+'& mdp='+mdp;
		//console.log(data);
		if(erreur==false){
			$.ajax({
				type : "POST",
				url : "connexion.php",
				data : data,
				success: function(server_response){
					//console.log(server_response);
					if(server_response==1){
						erreur=true;
						$("#erreurMDP").append("<img id='imgVerifC' src='imgs/fail.png' alt='Erreur de saisie'/>");}
					else if(server_response==2){
						erreur=true;
						$("#erreurLOGIN").append("<img id='imgVerifC' src='imgs/fail.png' alt='Erreur de saisie'/>");}
					else
						window.location.href="profil.php";
				}
			});
			}

	$("#mdpConnexion").keyup(function(e){
		$("#imgVerifC").remove();
		erreur=false;
		
	});
	
	$("#pseudoConnexion").keyup(function(e){
		$("#imgVerifC").remove();
		erreur=false;
		
	});
	
	
	
	});