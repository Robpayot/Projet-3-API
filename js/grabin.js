/* getDropDownDown(){
  document.getElementById('connexion-dropdown').className='dropdown-down';
}

function getDropDownUp(){
  document.getElementById('connexion-dropdown').className='dropdown-up';
} */
//variables pour avoir une unique fenêtre ouverte
var choix=document.getElementsByClassName('dropdown-down');
var choixDiv;
  
function getDropDownDown(id) {   

document.getElementById(id).className = 'dropdown-down';
 
for (i=0;i<choix.length;i++){
		if(choix[i].id!=id){
			choixDiv=choix[i];
			  setTimeout(function () {
					choixDiv.className = 'dropdown-up';
				}, 500);
			
		}
}


};


function getDropDownUp(id) {
  document.getElementById(id).className = 'dropdown-up';
};


function getOff(id) {
  document.getElementById(id).className = 'opacity-0';
  setTimeout(function () {
    document.getElementById(id).className = 'mobile-dspln';
  }, 200);
};

function getOffDesktop(id) {
  document.getElementById(id).className = 'opacity-0';
  setTimeout(function () {
    document.getElementById(id).className = 'dspln';
  }, 200);
};

function getOn(id) {
  document.getElementById(id).className = 'noclass opacity-0';
  setTimeout(function () {
    document.getElementById(id).className = 'opacity-1';
  }, 100);
};

function getAvatar() {
  document.getElementById('avatar').className = 'envoie opacity-0';
  document.getElementById('close-avatar').className = 'opacity-0';
  setTimeout(function () {
    document.getElementById('avatar').className = 'envoie opacity-1';
  }, 100);
  setTimeout(function () {
    document.getElementById('close-avatar').className = 'opacity-1';
  }, 100);
};

function getAvatarOff() {
  document.getElementById('avatar').className = 'envoie opacity-0';
  document.getElementById('close-avatar').className = 'opacity-0';
  setTimeout(function () {
    document.getElementById('avatar').className = 'dspln';
  }, 100);
  setTimeout(function () {
    document.getElementById('close-avatar').className = 'dspln';
  }, 100);
};

//$( "#date" ).datepicker({ dateFormat: 'dd/mm/yy' });


function afficher_cacher(id) {
  var id1 = "poster-video";
  var id2 = "poster-photo";

  if (id == id1)
    idb = id2;
  else
    idb = id1;

  document.getElementById(idb).style.display = "none";
  $("#" + id).stop().slideToggle(500, 'easeInSine');
  return false;
}

/*---- résultats recherche----*/
$('#recherche').focus(displayResults());
$('#recherche').blur(hideResults());
$('#resultat').css("opacity", "0");

function displayResults() {
  $('#resultat').css("opacity", "1");
}

function hideResults() {
  $('#resultat').css("opacity", "0");
}
