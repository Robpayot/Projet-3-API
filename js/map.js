
var map;
var initializeGeolocation;
var latLng;
var minZoomLvl = 12;

var skateparks = [
  ['Bercy', 48.83704, 2.378773, 4],
  ['Batignole', 48.890483, 2.315151, 5],
  ['Batignole', 48.890483, 2.315151, 3],
  ['Batignole', 48.890483, 2.315151, 2],
  ['Batignole', 48.890483, 2.315151, 1],
];

// initialisation de la carte
initializeGeolocation = function () {
    latLng = new google.maps.LatLng(48.857261, 2.341751);
    var myOptions = {
        zoom: minZoomLvl,
        scrollwheel: false,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: styles,
        zoomControl: true,
        streetViewControl: true,
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);

    setMarkers(map, skateparks);

    // Frontières de la carte --- http://stackoverflow.com/questions/3818016/google-maps-v3-limit-viewable-area-and-zoom-level
    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(48.816811, 2.251114),
        new google.maps.LatLng(48.902643, 2.408699)
    );

    // Listen for the dragend event
    google.maps.event.addListener(map, 'dragend', function () {
        if (strictBounds.contains(map.getCenter())) return;

        // We're out of bounds - Move the map back within the bounds

        var c = map.getCenter(), //récupère coord. du centre de la carte
            x = c.lng(), //récupère lng actuelle du centre
            y = c.lat(), //idem avec lat
            maxX = strictBounds.getNorthEast().lng(), //lng de l'angle en haut à droite de la map
            maxY = strictBounds.getNorthEast().lat(), //lat''''''''
            minX = strictBounds.getSouthWest().lng(), //lng de l'angle en bas à gauche de la map
            minY = strictBounds.getSouthWest().lat(); //lat''''''''

        //si le centre de la map est hors des frontières
        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;

        map.setCenter(new google.maps.LatLng(y, x));
    });

    // Empêcher de trop dézoomer
    google.maps.event.addListener(map, 'zoom_changed', function () {
        if (map.getZoom() < minZoomLvl) map.setZoom(minZoomLvl);
    });

};

//Affichage marqueurs
function setMarkers(map, locations) {
  for (var i = 0; i < locations.length; i++) {
    var skatepark = locations[i];
    var myLatLng = new google.maps.LatLng(skatepark[1], skatepark[2]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: skatepark[0],
        zIndex: skatepark[3]
    });
  }
}

// Affichage d'erreurs
function updateStatus(message) {
    document.getElementById("statut").innerHTML = message;
}

function handleError(error) {
    switch (error.code) {
    case 0:
        updateStatus("Votre position n'a pas pu être trouvée : " + error.message);
        break;
    case 1:
        updateStatus("Vous n'avez pas donné l'autorisation pour vous localiser. Vous pouvez néanmoins entrer votre adresse ci-dessous.");
        break;
    case 2:
        updateStatus("Votre navigateur n'a pas trouvé votre localisation : " + error.message);
        break;
    case 3:
        updateStatus("Votre navigateur n'a pas trouvé votre position : délai d'attente dépassé.");
        break;
    }
}
var latitude, longitude;
//Récupération des données de localisation
function findPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    accuracy = position.coords.accuracy;
    findOnGoogleMaps();
    //var xhr = new XMLHttpRequest();
    //var url = "trouve_position.php?lat=" + latitude + "&lng=" + longitude;
    //xhr.open("GET", url);
    //xhr.send(null);
}

//Message check in
var checkinSuccess = '<div id="content">' +
    '<h1 id="firstHeading" class="firstHeading">Tu es ici. Wanna checkin?</h1>' +
    '<div id="textInfoCheckin">' +
    '<form name="add_comment" ><label for="checkin_comment">Commentaire (<140 car.) :</label> <input type="text" id="checkin_comment" name="checkin_comment" /><br>' +
    '<a href="#" onclick="addCheckin()">OK</a></form></div>' +
    '</div>'; ///////////////SI CONFIRME, ALORS requete AJAX sur page PHP pour mettre les infos & comm dans BDD

//Création de l'infobulle
var infowindowCI = new google.maps.InfoWindow({
    content: checkinSuccess
});

function addCheckin() {
    //cancelDefaultAction(); //annule l'action du clic
    var comment = document.forms["add_comment"].elements[0].value;
    var url = "add_checkin.php?lat=" + latitude + "&lng=" + longitude + "&comm=" + comment;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.send(null);
    document.getElementById('firstHeading').innerHTML = "C'est fait !";
    document.getElementById('firstHeading').innerHTML = "Check in enregistré !";
}


//annule l'action par défaut de l'event js
function cancelDefaultAction() {
    //var evt = e ? e:window.event;
    if (evt.preventDefault) evt.preventDefault();
    evt.returnValue = false;
    return false;
}

//Cherche et affiche la position de l'utilisateur sur la carte
function findOnGoogleMaps() {
    currentPos = new google.maps.LatLng(latitude, longitude);
    map.setZoom(15);
    map.setCenter(currentPos);
    var markerPos = new google.maps.Marker({
        position: currentPos,
        map: map,
        title: "Votre position"
    });
    infowindowCI.open(map, markerPos);
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
    "featureType": "administrative.country",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.business",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.government",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "landscape.man_made",
    "elementType": "geometry",
    "stylers": [
      { "visibility": "on" },
      { "lightness": 34 }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "poi.place_of_worship",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "poi.school",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "poi.sports_complex",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "transit.line",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "transit.station.airport",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
  },{
    "featureType": "road.local",
    "stylers": [
      { "visibility": "on" },
      { "lightness": 47 }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "hue": "#66ff00" },
      { "lightness": -12 },
      { "saturation": 19 }
    ]
  },{
    "featureType": "water",
    "stylers": [
      { "lightness": -7 }
    ]
  },{
    "elementType": "geometry"  }
];

google.maps.event.addDomListener(window, 'load', initializeGeolocation);