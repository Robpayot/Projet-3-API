// JavaScript Document

var profil={
	defaults : {
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#dmd',
		statutDone : function(){},
		boutonAmitieDone : function(){},
		reponseAmitieDone : function(){},
	},
	
	init : function(options){
		this.params=$.extend(this.defaults,options);
	},
	
	afficherlisteDesDemandes:function(){
			 url="listeDmd.php";
			 
					$.ajax({
				type : "GET",
				url : url,
				success: function(server_response){
					
					$(profil.params.divDemandesAmi).html(server_response).show();
				}
			});
			
		},
	
	ChangementEtatBoutonAmitie : function(URL){$.ajax({
				type : "GET",
				url : URL,
				data : "demande=2",
				success: function(server_response){
					profil.params.boutonAmitieDone.call(this,server_response);

				}
			});
			
		},
	reponseAmitie:function(e){		
		
			var classe=e.toElement.className;
			datas='accepte='+$("."+classe).attr('data-accepte')+'&ami='+$("."+classe).attr('data-ami');
			
			url="acceptationAmitie.php";
			
			$.ajax({
				type : "GET",
				url : url,
				data: datas,
				success: function(choix){
					profil.params.reponseAmitieDone.call(this,choix);					
				}
			});
			
		},
	nouveauStatut: function(){
		var statut=$(profil.params.champStatut).val();
		console.log("statut= "+statut);
		var data='statut='+statut;
		
		if(statut.length>0){
			
			$.ajax({
				type : "POST",
				url : "statut.php",
				data : data,
				success: function(server_response){
					$(profil.params.champStatut).val('');
					profil.params.statutDone.call(this, server_response);
					
				}
			});
		}
	}
	
}
