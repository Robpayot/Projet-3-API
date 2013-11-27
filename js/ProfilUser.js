// JavaScript Document


profil.init({
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#dmd',
		divAmis:'#liste-amis',
		divResultRecherche:'#resultat',
		divClassement:'#classement-dropdown ul',
		statutDone : function(server_response){
				$('#newStatut').val('');
				$("#status").html(server_response);
				$("#envoiStatut").attr('disabled',false);			
			},
		boutonAmitieDone : function(server_response){
			console.log("etat amitie"+server_response);
					if(server_response==1)
						$('#dmdAmi').attr("value","se desabonner");
					else if (server_response==0)
						$('#dmdAmi').attr("value","demande envoyée").attr('disabled',true);
					else
						$('#dmdAmi').attr("value","s'abonner");
				
						//$("#demande").html(server_response).show();
						}
						,
						
		reponseAmitieDone : function(choix){
			console.log("doneee!!");
					profil.afficherlisteDesDemandes();
				
			},
});


var notif;
//Liste checkins
profil.evenement();

//recherche
 $("#recherche").keyup(function(){
		var recherche=$(this).val();
		profil.rechercheUser(recherche);
	});

 $("#recherche").focus(function(e) {
	  var recherche=$(this).val(); 
	  if(recherche==null){
			$("#resultat").hide();
		}
});


//Voir classement
profil.classement();

//Liste des amis
profil.afficherlisteDesAmis(1);
$("#voirAmis").click(function(e) {
	profil.afficherlisteDesAmis(1);
});

//Liste des demandes d'amis
profil.afficherlisteDesDemandes();
$("#voirDemandes").click(function(e) {
	profil.afficherlisteDesDemandes();
});
//notif=setInterval(profil.afficherlisteDesDemandes(),1000);

//Reponse demande ami
$('.demandesAmi').click(function() {
	console.log(event.srcElement.className);
	profil.reponseAmitie(event.srcElement);
	
});


//statut
$("#envoiStatut").click(function(){
		$(this).attr('disabled',true);
		//pour le resultat Voir statutDone
		profil.nouveauStatut();
	});

//Supprimer checkin
$('#list-checkins').on('click','.suppr',function(e) {
	var r = confirm("Supprimer le checkin?");
		if (r == true)
		  {
		  	var idCheck=e.target.parentElement.value;
			//console.log(this.attr("value"));
			profil.supprCheck(idCheck);
	
		  }
	//console.log(e.target);
	//console.log(e);
	//console.log(this.attr("value"));
	
	
});
