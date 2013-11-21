// JavaScript Document


	profil.ChangementEtatBoutonAmitie("gestionProfilVisite.php",3);
    
	$("#dmdAmi").click(function(e) {
		if($('#dmdAmi').attr("value")=="se desabonner")
			profil.ChangementEtatBoutonAmitie("dmdAmi.php",1);
		else{
			$(this).attr('disabled',true);
			profil.ChangementEtatBoutonAmitie("dmdAmi.php",2);
		}
		//pour le resultat Voir boutonAmitieDone

    });

