// JavaScript Document

profil.init({
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#liste-abonnes',
		divAmis:'#liste-amis',
		statutDone : function(server_response){
				$('#newStatut').val('');
				$("#status").html(server_response).show();
				$("#envoiStatut").attr('disabled',false);			
			},
		boutonAmitieDone : function(server_response){},
		reponseAmitieDone : function(choix){
					profil.afficherlisteDesDemandes();
					
					if(choix==1)
						alert('Vous êtes maintenant amis');
					else
						alert('Vous avez refusé');
			},
});
var notif;
function affiche_bonjour(){
	alert("bonjour");
}

$(document).ready(function(){
     //notif=setInterval(affiche_bonjour, 5000);
});

$(document).keydown(function(){
	console.log("keyyy");
     clearInterval(notif);
});

profil.afficherlisteDesAmis(1);

//Liste des demandes d'amis
	profil.afficherlisteDesDemandes();
	
//Reponse demande ami

$('.demandesAmi').click(function(e) {
	profil.reponseAmitie(e);
	
});


//statut
    $("#envoiStatut").click(function(){
		$(this).attr('disabled',true);
		//pour le resultat Voir statutDone
		profil.nouveauStatut();
	});
