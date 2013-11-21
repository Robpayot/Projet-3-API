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

$('#recherche').focus(displayResults());
$('#recherche').blur(hideResults());
$('#resultat').css("opacity","0");

$( "#date" ).datepicker({ dateFormat: 'dd/mm/yy' });


function afficher_cacher(id){
	if(document.getElementById(id).style.display=="none")
    {
    	document.getElementById(id).style.display="block";
    } else {
    	document.getElementById(id).style.display="none";
    }

    if(id=='poster-photo'){
    	if(document.getElementById('poster-video').style.display=="block")
	    {
	    	document.getElementById('poster-video').style.display="none";
	    } 
    } else if(id=='poster-video'){
    	if(document.getElementById('poster-photo').style.display=="block")
	    {
	    	document.getElementById('poster-photo').style.display="none";
	    }
	} 
    
    return false;
}

function displayResults(){
	console.log("FOCUS");
	$('#resultat').css("opacity","1");
}

function hideResults(){
	console.log("BLUR");
		$('#resultat').css("opacity","0");
		//$('#recherche').val("");
}

