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

//$( "#date" ).datepicker({ dateFormat: 'dd/mm/yy' });

function getOff(id){
  document.getElementById(id).className='opacity-0';
  setTimeout(function(){document.getElementById(id).className='mobile-dspln';},200);
};

function getOn(id){
  document.getElementById(id).className='noclass opacity-0';
  setTimeout(function(){document.getElementById(id).className='opacity-1';},100);
};

$('#recherche').focus(displayResults());
$('#recherche').blur(hideResults());
$('#resultat').css("opacity","0");

$( "#date" ).datepicker({ dateFormat: 'dd/mm/yy' });


function afficher_cacher(id){
	var id1="poster-video";
	var id2="poster-photo";

//document.getElementById(id1).style.display="none";
//document.getElementById(id2).style.display="none";
	
	if(id==id1)
		idb=id2;
	else
		idb=id1;
	

//document.getElementById(idb).style.display="none";
	$( "#"+idb ).stop().fadeOut(100,'easeInSine');
	
	$( "#"+id ).stop().delay(100).slideToggle(700,'easeInSine');
//$( "#"+idb ).stop().slideToggle(1000,'easeInOutBack');
    	//document.getElementById(id).style.display="none";


    /*if(id=='poster-photo'){
    	if(document.getElementById('poster-video').style.display=="block")
	    {
			$( "#poster-video" ).slideToggle(1000,'easeInOutBack');
	    	//document.getElementById('poster-video').style.display="none";
	    } 
    } else if(id=='poster-video'){
    	if(document.getElementById('poster-photo').style.display=="block")
	    {
			$( "#poster-photo" ).slideToggle(1000,'easeInOutBack');
	    	//document.getElementById('poster-photo').style.display="none";
	    }
	} */
    
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

