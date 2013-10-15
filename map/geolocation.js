var map;
var initializeGeolocation;
var latLng;

// initialisation de la carte
initializeGeolocation = function(){
	latLng = new google.maps.LatLng(48.857261,2.341751); 
	var myOptions = {
	    zoom      : 13, 
	    center    : latLng, 
	    mapTypeId : google.maps.MapTypeId.ROADMAP, 
	    styles: styles,
	    zoomControl:true,
	    streetViewControl:true,
    };
  
    map      = new google.maps.Map(document.getElementById('map-canvas'), myOptions);

//MARQUEURS SUR LA CARTE
	var rep = new google.maps.Marker({
	    position : new google.maps.LatLng(48.869006,2.364067),
	    map      : map,
	    title    : "République",
	});

	var bastille = new google.maps.Marker({
	    position : new google.maps.LatLng(48.85311,2.36965),
	    map      : map,
	    title    : "Bastille",
	});

//INFOBULLE REPUBLIQUE
//Contenu
var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">République</h1>'+
      '<div id="bodyContent">'+
      '<p>Actuellement <b>? personnes</b></p>'+
      '</div>'+
      '</div>';
//Création de l'infobulle
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
//Ouverture au clic sur le marqueur république
	google.maps.event.addListener(rep, 'click', function() {
	    infowindow.open(map,rep);
	});

};

// Affichage d'erreurs
function updateStatus(message) {
	document.getElementById("statut").innerHTML = message;
}
        
function handleError(error) {
	switch (error.code) {
		case 0:
			updateStatus("Votre position n'a pas pu être trouvée : "+ error.message);
		break;
		case 1:
			updateStatus("Vous n'avez pas donné l'autorisation pour vous localiser. Vous pouvez néanmoins entrer votre adresse ci-dessous.");
		break;
		case 2:
			updateStatus("Votre navigateur n'a pas trouvé votre localisation : "+ error.message);
		break;
		case 3:
			updateStatus("Votre navigateur n'a pas trouvé votre position : délai d'attente dépassé.");
		break;
	}
}
        
//Récupération des données de localisation
function findPosition(position) {
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
	accuracy = position.coords.accuracy;
  findOnGoogleMaps();
var xhr = new XMLHttpRequest();
var url = "ajout_checkin.php?lat=" + latitude + "&lng=" + longitude;
xhr.open("GET", url);
xhr.send(null);
}
	
	//Message check in
var checkinSuccess = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Tu es ici</h1>'+
      '</div>';
//Création de l'infobulle
  var infowindowCI = new google.maps.InfoWindow({
      content: checkinSuccess
  });

//Cherche et affiche la position de l'utilisateur sur la carte
function findOnGoogleMaps() {
	currentPos = new google.maps.LatLng(latitude, longitude);
	map.setZoom(15);
	map.setCenter(currentPos);
	var markerPos = new google.maps.Marker({
		position : currentPos,
		map : map,
		title : "Votre position"
	});
	infowindowCI.open(map,markerPos);
}
	
	
//trouve la position courante de l'utilisateur
function findLocation() {		
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(findPosition, handleError);
	} else {
		updateStatus("Votre navigateur ne supporte pas la géolocalisation, indiquez votre adresse dans le champs ci-dessus.");
	}		
}




//Style de la carte (couleurs)
var styles = [
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      { "color": "#808080" },
      { "lightness": 97 }
    ]
  },{
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      { "color": "#7f8080" },
      { "lightness": 72 }
    ]
  },{
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      { "color": "#3d9eea" },
      { "saturation": -50 },
      { "lightness": 34 }
    ]
  },{
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      { "color": "#e95b5c" },
      { "lightness": 50 }
    ]
  },{
    "elementType": "labels.text.fill",
    "stylers": [
      { "color": "#000000" },
      { "lightness": 28 }
    ]
  },{
    "elementType": "labels.text.stroke",
    "stylers": [
      { "color": "#ffffff" }
    ]
  },{
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      { "color": "#ea5b5c" },
      { "lightness": 83 }
    ]
  }
];

google.maps.event.addDomListener(window, 'load', initializeGeolocation);
