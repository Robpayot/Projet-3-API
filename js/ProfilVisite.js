// JavaScript Document



profil.init({
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#dmd',
		//profil user
		statutDone : function(){},
		//profil visite
		boutonAmitieDone : function(server_response){
					if(server_response ==1)
						$('#dmdAmi').attr("value","Suivi(e)").attr('disabled',true);
					else if (server_response ==0)
						$('#dmdAmi').attr("value","demande envoyée").attr('disabled',true);
					
						
					$("#demande").html(server_response).show();
			},
		reponseAmitieDone : function(){},
});


	profil.ChangementEtatBoutonAmitie("gestionProfilVisite.php");
    
	$("#dmdAmi").click(function(e) {
		$(this).attr('disabled',true);
		profil.ChangementEtatBoutonAmitie("dmdAmi.php");
		//pour le resultat Voir boutonAmitieDone

    });

