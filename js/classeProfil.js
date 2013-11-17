// JavaScript Document

var profil={
	defaults : {
		boutonDemandeAmitie:'#dmdAmi',
		champStatut:'#newStatut',
		divDemandesAmi:'#liste-abonnes',
		divAmis:'#dmd',
		statutDone : function(){},
		boutonAmitieDone : function(){},
		reponseAmitieDone : function(){},
	},
	
	init : function(options){
		this.params=$.extend(this.defaults,options);
	},
	
	afficherlisteDesAmis:function(datas){
			 url="ListeAmis.php";
			 
			 
			$.ajax({
				type : "GET",
				url : url,
				data : "demandeA="+datas,
				success: function(server_response){
					console.log (server_response);
					if(datas==2){
						var amisId=JSON.parse(server_response);
						console.log(amisId.ami2);
						$(profil.params.divAmis).html(amisId.ami0).show();
					}
					else{		
						$(profil.params.divAmis).html(server_response).show();
					}
				},
				error:  function(e){
					console.log (e);
					console.log("erreur");
				}
			});
			
		},
	
	afficherlisteDesDemandes:function(){
			 url="listeDmd.php";
			 
					$.ajax({
				type : "GET",
				url : url,
				success: function(server_response){
					console.log(profil.params.divDemandesAmi);
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
		var data='statut='+statut;
		
		if(statut.length>0){
			
			$.ajax({
				type : "POST",
				encoding:"UTF-8",
				url : "statut.php",
				data : data,
				success: function(server_response){
					$(profil.params.champStatut).val('');
					console.log(server_response);
					profil.params.statutDone.call(this, server_response);
					
				}
			});
		}
	}
	
}
