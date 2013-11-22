// JavaScript Document


profil.init({
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#dmd',
		divAmis:'#liste-amis',
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
profil.evenement();


//Classement
  function Classement(){
        $.ajax({
            type: "GET",
            url: "classement.php",
            success: function (server_response) {
                $("#classement-dropdown ul").append(server_response);

            }
        });

    }
	
Classement();

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
notif=setInterval(profil.afficherlisteDesDemandes(),60000);

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

$('#list-checkins').click(function(e) {
	console.log(e.target.value);
	var idCheck=e.target.value;
	//console.log(this.attr("value"));
	profil.supprCheck(idCheck);
	
});
