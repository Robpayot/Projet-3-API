
var map;
var initializeMap;
var latLng;
var minZoomLvl = 13;
var geocoder;
var date="2013-11-10"; //remplacer par actuelle
var hour="13:00";

//skateparks list
var skateparks = [
  ['JulesNoel', 48.824381, 2.314923, 11],
  ['Porte d\'Orleans', 48.821641, 2.322991, 10],
  ['EGP 18', 48.899653, 2.36517, 9],
  ['Cladel', 48.868518, 2.342755, 8],
  ['Charonne', 48.856324, 2.388413, 7],
  ['Louis Vicat', 48.826093, 2.297053, 6],
  ['Bercy', 48.83704, 2.378773, 5],
  ['Batignole', 48.890483, 2.315151, 4],
  ['Fougeres', 48.872707, 2.412882, 3],
  ['St Ouen', 48.899611, 2.330257, 2],
  ['La Muette', 48.864877, 2.26866, 1],
];

// initialize the map
initializeMap = function () {

    geocoder = new google.maps.Geocoder();
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

    //Create the map
    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);

    //Display the skateparks' markers
    setMarkers(map, skateparks);
    //Get the information about the skaters and display the skaters' markers on the map
    getCheckin();

    // Limit of the map --- http://stackoverflow.com/questions/3818016/google-maps-v3-limit-viewable-area-and-zoom-level
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

    // prevent the user from (de)zooming 
    google.maps.event.addListener(map, 'zoom_changed', function () {
      if (map.getZoom() < minZoomLvl) map.setZoom(minZoomLvl);
    });

};


//displaying markers on the map
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
    var skateparkName = "";
    var infoSkatepark = new google.maps.InfoWindow({
      content: skatepark[0]
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infoSkatepark.setContent(locations[i][0]);
          infoSkatepark.open(map, marker);
        }
    })(marker, i));
  }
}


// Display localisation error messages
function updateStatus(message) {
    document.getElementById("statut").innerHTML = message;
}

function handleError(error) {
    switch (error.code) {
    case 0:
        updateStatus("Votre position n'a pas pu être trouvée : " + error.message);
        break;
    case 1:
        updateStatus("Vous n'avez pas donné l'autorisation pour vous localiser. Vous ne pouvez donc pas vous enregistrer sur la carte.");
        break;
    case 2:
        updateStatus("Votre navigateur n'a pas trouvé votre localisation : " + error.message);
        break;
    case 3:
        updateStatus("Votre navigateur n'a pas trouvé votre position : délai d'attente dépassé.");
        break;
    }
}

var posLatitude, posLongitude;
var addressLocation;
//get the geaolocation datas and check if the skater is in paris or not
function findPosition(position) { 
    posLatitude = position.coords.latitude;
    posLongitude = position.coords.longitude;
    accuracy = position.coords.accuracy;
    var ltlng = new google.maps.LatLng(posLatitude, posLongitude);
    geocoder.geocode({'latLng': ltlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        console.log(results[4].formatted_address);
        addressLocation = results[1].formatted_address;
        console.log('Adresse : '+addressLocation);
        //if(results[4].formatted_address!="Paris, France" ) {
          //alert("Le service n'est disponible qu'à Paris pour le moment, tu ne peux donc pas te géolocaliser ici, désolé !");
        //} else {
          findOnGoogleMaps();
        //}
      } else {
        console.log('No results found');
      }
    } else {
      console.log('Geocoder failed due to: ' + status);
    }
  });
}

//Message if success check in
var checkinSuccess = '<div id="content">' +
    '<h1 id="firstHeading" class="firstHeading">Tu es ici. Wanna checkin?</h1>' +
    '<div id="textInfoCheckin">' +
    '<form name="add_comment" ><label for="checkin_comment">Commentaire (<140 car.) :</label> <input type="text" id="checkin_comment" name="checkin_comment" /><br>' +
    '<a href="#" onclick="addCheckin()">OK</a></form></div>' +
    '</div>';

//Create the window info
var infowindowCI = new google.maps.InfoWindow({
    content: checkinSuccess
});

//Add the checkin datas in the database
function addCheckin() {
    //cancelDefaultAction();
    var comment = document.forms["add_comment"].elements[0].value;
    var url = "add_checkin.php?lat=" + posLatitude + "&lng=" + posLongitude + "&comm=" + comment;
    var request = $.ajax({
      url: url,
      //type: "POST",
      //data: { id : menuId },
      //dataType: "html"
    });
     
    request.done(function(  ) {
      $( "#textInfoCheckin" ).html( "C'est fait !" );
      $( "#firstHeading" ).html( "Check in enregistré !" );
    });
     
    request.fail(function( jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );
      $( "#textInfoCheckin" ).html( "oops!" );
      $( "#firstHeading" ).html( "Il semble qu'il y ai  eu un problème" );
    });
    //var xhr = new XMLHttpRequest();
    //xhr.open("GET", url);
    //xhr.send(null);
    //document.getElementById('textInfoCheckin').innerHTML = "C'est fait !";
    //document.getElementById('firstHeading').innerHTML = "Check in enregistré !";
}

//get the datas of the checkin registered in the database
function getCheckin() {
    //cancelDefaultAction();  ///////// ???
    var url = "getcheckin.php";
    $.get( url, function( data ) {
      var locationsData=JSON.parse(data);
            var count = locationsData.json.length;
            //console.log(locationsData);
            for(var i=0;i<count;i++) {
              setMarkersCheckin(map,locationsData.json[i]);
            }
    });
    //var xhr = new XMLHttpRequest();
    //xhr.open("GET", url);
    //xhr.send(null);
    //xhr.onreadystatechange = function() {
    //    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
    //        var locationsData=JSON.parse(xhr.responseText);
    //        var count = locationsData.json.length;
    //        console.log(locationsData);
    //        for(var i=0;i<=count;i++) {
     //         setMarkersCheckin(map,locationsData.json[i]);
    //        }
    //    }
    //};
}



function changeDate() {
  date = document.getElementById('date').value;
  //console.log(date);
  //setMarkersCheckin(map,null);
  getCheckin();
}

function changeHour() {
  hour = document.getElementById('hour').value;
  //console.log(hour);
  //setMarkersCheckin(map,null);
  getCheckin();
}

//display the position of the skaters checked in
function setMarkersCheckin(map,locations) {
  //console.log(date); console.log(hour);
  var timeChoosen=date+' '+hour;
  //console.log(locations);
  //console.log(locations.date_debut+" / "+timeChoosen+" / "+locations.date_fin);
  var debut=locations.date_debut;
  if((debut<timeChoosen) && (timeChoosen<locations.date_fin)) {
    console.log("setMarkersCheckin");  
    var id = locations.id;
    //console.log(locations.id);
    var myLatLng = new google.maps.LatLng(locations.lat, locations.lng);
    //console.log(locations.lat+', '+locations.lng);
    var markerChekin = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: id,
    });
    var checkinInfo = '<h3>'+locations.pseudo+'</h3>'+
                      '"'+locations.comment+'" <br>'+
                      "Du "+locations.date_debut+" à "+locations.date_fin;
    var infoCheckin = new google.maps.InfoWindow({
      content: checkinInfo
    });
    google.maps.event.addListener(markerChekin, 'click', (function() {
          infoCheckin.open(map, markerChekin);
    }));
  }
}



//annule l'action par défaut de l'event js//
////////////////////////////////////////////
//////////////A GARDER ?////////////////////
////////////////////////////////////////////
function cancelDefaultAction(e) {
    var evt = e ? e:window.event;
    if (evt.preventDefault) evt.preventDefault();
    evt.returnValue = false;
    return false;
}

//Find and display the position of the user on the map
function findOnGoogleMaps() {
    currentPos = new google.maps.LatLng(posLatitude, posLongitude);
    map.setZoom(15);
    map.setCenter(currentPos);
    var markerPos = new google.maps.Marker({
        position: currentPos,
        map: map,
        title: "Votre position"
    });
    infowindowCI.open(map, markerPos);
}


//get the location via the browser
function findLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(findPosition, handleError);
    } else {
        updateStatus("Votre navigateur ne supporte pas la géolocalisation, indiquez votre adresse dans le champs ci-dessus.");
    }
}




//colors of the map
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

google.maps.event.addDomListener(window, 'load', initializeMap);

