// JavaScript Document

profil.init({
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#dmd',
		divAmis:'#liste-amis',
		statutDone : function(server_response){
				$('#newStatut').val('');
				$("#status").html(server_response).show();
				$("#envoiStatut").attr('disabled',false);			
			},
		boutonAmitieDone : function(server_response){
			console.log("etat amitie"+server_response);
					if(server_response==1)
						$('#dmdAmi').attr("value","Suivi(e)").attr('disabled',true);
					else if (server_response==0)
						$('#dmdAmi').attr("value","demande envoyée").attr('disabled',true);
						
						$("#demande").html(server_response).show();},
						
		reponseAmitieDone : function(choix){
			console.log("doneee!!");
					profil.afficherlisteDesDemandes();
				
			},
});

var notif;
/*function affiche_bonjour(){
	alert("bonjour");
}*/

$(document).ready(function(){
     //notif=setInterval(affiche_bonjour, 5000);
});

$(document).keydown(function(){
     //clearInterval(notif);
});

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
//Reponse demande ami

$('.demandesAmi').click(function(e) {
	console.log(e);
	profil.reponseAmitie(e);
	
});


//statut
    $("#envoiStatut").click(function(){
		$(this).attr('disabled',true);
		//pour le resultat Voir statutDone
		profil.nouveauStatut();
	});
