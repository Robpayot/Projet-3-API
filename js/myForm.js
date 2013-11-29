// JavaScript Document

verifFormulaireInsc.init({
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
	});
	
function reseT(){
	verifFormulaireInsc.params.Vmdp=false;
	verifFormulaireInsc.params.pseudoFree=false;
	var checkbox=document.getElementsByName('check[]');
	for(var i=0; i<checkbox.length;i++){
			checkbox[i].checked=false;
			}
	
}
$('#btn-co').click(function(e){reseT();});
$('#btn-fbco').click(function(e){reseT();});

//Verification mot de passe
$("#retape_mdp").keyup(function(){
	verifFormulaireInsc.verifMdp(verifFormulaireInsc.params.retape,verifFormulaireInsc.params.mdp,verifFormulaireInsc.params.imgVerif);
})
//Verification mot de passe (avec Facebook)
$("#retape_mdpFb").keyup(function(){
		verifFormulaireInsc.verifMdp(verifFormulaireInsc.params.retapeFb,verifFormulaireInsc.params.mdpFb,verifFormulaireInsc.params.imgVerifFb);
})
//Verification pseudo
$("#pseudo").keyup(function(){
		verifFormulaireInsc.verifPseudo(verifFormulaireInsc.params.pseudo,verifFormulaireInsc.params.imgVerifPseudo);
})
//Verification pseudo (avec Facebook)
$("#pseudoFb").keyup(function(){
	verifFormulaireInsc.verifPseudo(verifFormulaireInsc.params.pseudoFb,verifFormulaireInsc.params.imgVerifPseudoFb);
})

//Verification: tous les champs du formulaire sont remplis ?
$("#formInsc").keyup(function(e) {verifFormulaireInsc.disab(verifFormulaireInsc.params.sinscrire);});
$("#formInsc").click(function(e) {verifFormulaireInsc.disab(verifFormulaireInsc.params.sinscrire)});
$("#formInscFb").keyup(function(e) {verifFormulaireInsc.disab(verifFormulaireInsc.params.sinscrireFb)});
$("#formInscFb").click(function(e) {verifFormulaireInsc.disab(verifFormulaireInsc.params.sinscrireFb)});
