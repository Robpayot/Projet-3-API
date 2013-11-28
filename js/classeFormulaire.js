// JavaScript Document


var verifFormulaireInsc = {
    defaults: {
	    pseudoFb: '#pseudoFb',
        pseudo: '#pseudo',
        mdp: '#mdp',
        mdpFb: '#mdpFb',
		retape:'#retape_mdp',
		retapeFb:'#retape_mdpFb',
        sinscrire: '#envoie',
        sinscrireFb: '#envoieFb',
		imgVerifPseudo:'#imgVerifPseudo',
		imgVerifPseudoFb:'#imgVerifPseudoFb',
		imgVerif:'#imgVerif',
		imgVerifFb:'#imgVerifFb',
		Vmdp:false,
		pseudoFree:false

    },

    init: function (options) {
        this.params = $.extend(this.defaults, options);
    },
//Verification: les mots de passes correspondent	
	verifMdp: function(retaper,mdp,imgVerif){
		var retape=$(retaper).val();
		console.log(retape);
				if(retape.length>1){
			
					if(retape==$(mdp).val()){
						$(imgVerif).attr("src","imgs/check.png");
						verifFormulaireInsc.params.Vmdp=true;
					}
					else{
						$(imgVerif).attr("src","imgs/fail.png");
						verifFormulaireInsc.params.Vmdp=false;
					}

		}
		
	},
//Verification de la disponibilité du pseudo
	verifPseudo: function(pseudo,imgVerif){
		var test_pseudo=$(pseudo).val();
		
		var data='test_pseudo='+test_pseudo;
		
		if(test_pseudo.length>2){
			
			$.ajax({
				type : "GET",
				url : "sinscrire.php",
				data : data,
				success: function(server_response){
					
					if(server_response==0){
						$(imgVerif).attr("src","imgs/check.png");
						verifFormulaireInsc.params.pseudoFree=true;
					}
					else{
						$(imgVerif).attr("src","imgs/fail.png");
						verifFormulaireInsc.params.pseudoFree=false;
					}
				}
			});
		}
		else{
			$(imgVerif).attr("src","imgs/fail.png");
			verifFormulaireInsc.params.pseudoFree=false;
			
		}
		
	},
	//Verification que toutes les informations sont rentrées
		disab: function(sinscrire){
			var check=false;
			var checkbox=document.getElementsByName('check[]');
			for(var i=0; i<checkbox.length;i++){
				if(checkbox[i].checked == true){
					check=true;
				}
			}
		 	if(verifFormulaireInsc.params.Vmdp && verifFormulaireInsc.params.pseudoFree && check){
				$(sinscrire).removeClass().addClass('envoie');
				$(sinscrire).attr("disabled",false);
			}
			else{
				$(sinscrire).removeClass().addClass('greyenvoie');
				$(sinscrire).attr("disabled",true);
			}
				
				console.log(document.getElementsByName('check[]')[0]);
		
		
	}
	
	
}