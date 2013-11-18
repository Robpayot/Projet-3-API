/* getDropDownDown(){
  document.getElementById('connexion-dropdown').className='dropdown-down';
}

function getDropDownUp(){
  document.getElementById('connexion-dropdown').className='dropdown-up';
} */



function getDropDownDown(id){
  document.getElementById(id).className='dropdown-down';
};


function getDropDownUp(id){
  document.getElementById(id).className='dropdown-up';
};

/*$('#recherche').focus( function() {
	console.log("FOCUS");
	$('#resultat').css("opacity","1");
});*/

function displayResults(){
	console.log("FOCUS");
	$('#resultat').css("opacity","1");
}

function hideResults(){
	console.log("FOCUS");
	$('#resultat').css("opacity","0");
}
