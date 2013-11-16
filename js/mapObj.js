var map;
var initializeMap;
var latLng;
//var minZoomLvl = 13;
var geocoder;
var debut;
var fin;
var pseudo;
var comment;
var date="2013-11-10"; //remplacer par actuelle
var hour="13:00";
var markerChekin;
var indiceMarker;
var markers = [];
var posLatitude, posLongitude;
var addressLocation;
var latPlan, lngPlan;
//Message if success check in
var checkinSuccess = '<div id="content">' +
	'<h1 id="firstHeading" class="firstHeading">Tu es ici. Wanna checkin?</h1>' +
	'<div id="textCheckin">' +
	'<form name="add_comment" onsubmit="return mapObj.addCheckin()"><label for="checkin_comment">Commentaire (<140 car.) :</label> <input type="text" id="checkin_comment" name="checkin_comment" /><br>' +
	'<input type="submit" value="OK"></form></div>' +
	'</div>';

//Create the window info
var infowindowCI = new google.maps.InfoWindow({
    content: checkinSuccess
});
var markerPlan;



var mapObj = {

	defaults : {
		mapDiv : '#map-canvas',
		styles : [],
		skateparks : new Array(),
		minZoomLvl : 12,
		checkinButton : '#find',

		initializedMap : function () {},
		gotCheckin : function() {},
	},


	init : function(options){
		this.params=$.extend(this.defaults,options);
	},

	initializeMap : function() {
		console.log('initialisation de la map');
		geocoder = new google.maps.Geocoder();
	    latLng = new google.maps.LatLng(48.857261, 2.341751);

	    var myOptions = {
	        zoom: mapObj.params.minZoomLvl,
	        scrollwheel: false,
	        center: latLng,
	        mapTypeId: google.maps.MapTypeId.ROADMAP,
	        styles: mapObj.params.styles,
	        zoomControl: true,
	        streetViewControl: true,
	        zoomControlOptions: {
	            style: google.maps.ZoomControlStyle.LARGE,
	            position: google.maps.ControlPosition.LEFT_BOTTOM
	        },
	    };

	    //Create the map

	    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);//$(mapObj.params.mapDiv)

	    //Plan a checkin by clicking on the map
	    var plan=false;
	    google.maps.event.addListener(map, 'click', function(event) {
	    	if(plan==false){
	    	plan=true;
		    console.log(event.latLng);
		    latPlan=event.latLng.ob;
		    lngPlan=event.latLng.pb;
		    	mapObj.addMarkerPlan(event.latLng);
		    	mapObj.windowPlanCheckin(event.latLng);
			} else {
				mapObj.removeMarkerPlan();
				plan=false;
			}
		});

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
	      if (map.getZoom() < mapObj.params.minZoomLvl) map.setZoom(mapObj.params.minZoomLvl);
	    });

	    mapObj.params.initializedMap.call(this);
	},

	//displaying markers on the map
	setMarkers: function(map, locations) {
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
	},

	//get the datas of the checkin registered in the database
	getCheckin : function() {
	    var url = "get_checkin.php";
	    $.get( url, function( data ) {
	      var locationsData=JSON.parse(data);
	      var count = locationsData.json.length;
	      console.log(locationsData);
	      mapObj.params.gotCheckin.call(this,locationsData,count); 
	    });
	},

	changeDate:function() {
	  date = document.getElementById('date').value;
	  //console.log(date);
	  //setMarkersCheckin(map,null);
	  mapObj.deleteMarkers();
	  mapObj.getCheckin();
	},

	changeHour:function() {
	  hour = document.getElementById('hour').value;
	  //console.log(hour);
	  //setMarkersCheckin(map,null);
	  mapObj.deleteMarkers();
	  mapObj.getCheckin();
	},

	// Add a marker to the map and push to the array.
	addMarker : function(location) {
	  markerChekin = new google.maps.Marker({
	    position: location,
	    map: map
	  });
	  markers.push(markerChekin);
	},

	// Sets the map on all markers in the array.
	setAllMap : function(map) {
	  for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	  }
	},

	// Removes the markers from the map, but keeps them in the array.
	clearMarkers : function() {
	  mapObj.setAllMap(null);
	},

	// Deletes all markers in the array by removing references to them.
	deleteMarkers : function() {
	  mapObj.clearMarkers();
	  markers = [];
	},

	//display the position of the skaters checked in
	setMarkersCheckin: function(map,locations) {
	  var timeChoosen=date+' '+hour;
	  //console.log(locations);
	  debut=locations.date_debut;
	  fin=locations.date_fin;
	  pseudo = locations.pseudo;
	  comment = locations.comment;
	  var myLatLng = new google.maps.LatLng(locations.lat, locations.lng);

	  if((debut<timeChoosen) && (timeChoosen<fin)) {
	    console.log(locations.date_debut+" / "+timeChoosen+" / "+locations.date_fin);
	    console.log("setMarkersCheckin");  
	    
	    var checkinInfo = '';

	    //Initialiser la variable dans laquelle va être construit l'objet InfoBubble
		var infobulle = new InfoBubble({
			map: map,
			content: checkinInfo,  // Contenu de l'infobulle
			position: event.latLng,  // Coordonnées latitude longitude du marker
			shadowStyle: 0,  // Style de l'ombre de l'infobulle (0, 1 ou 2)
			padding: 0,  // Marge interne de l'infobulle (en px)
			backgroundColor: 'rgb(255,255,255)',  // Couleur de fond de l'infobulle
			borderRadius: 0, // Angle d'arrondis de la bordure
			arrowSize: 10, // Taille du pointeur sous l'infobulle
			borderWidth: 0,  // Épaisseur de la bordure (en px)
			borderColor: '#009EE0', // Couleur de la bordure
			disableAutoPan: true, // Désactiver l'adaptation automatique de l'infobulle
			hideCloseButton: false, // Cacher le bouton 'Fermer'
			arrowPosition: 50,  // Position du pointeur de l'infobulle (en %)
			arrowStyle: 0,  // Type de pointeur (0, 1 ou 2)
			disableAnimation: false,  // Déactiver l'animation à l'ouverture de l'infobulle
			maxWidth :   150  // Largeur minimum de l'infobulle  (en px)
		});

		mapObj.addMarker(myLatLng);

		google.maps.event.addListener(markerChekin, 'click', (function() {
	      for (var j=0;j<markers.length; j++){
	          if((this.position.ob==markers[j].position.ob)&&(this.position.pb==markers[j].position.pb)){
	            indiceMarker=j;
	          }
	        }
	        infobulle.open(map,markers[indiceMarker]);
	    }));

	    
	    var addressCheckin;
	    geocoder.geocode({'latLng': myLatLng}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      if (results[1]) {
		        addressCheckin = results[1].formatted_address;
		        infobulle.setContent('<p id="pseudo-checkin">'+locations.pseudo+'</p>'+
	                      '<div id="content-infocheckin"><span id="addressCheckin">'+addressCheckin+'</span><br>'+
	                      '<span class="dateCheckin">Du '+locations.date_debut+' à '+locations.date_fin+'</span><br>'+
	                      '<span>"'+locations.comment+'"</span></div>');
		      } else {
		        console.log('No results found');
		      }
		    } else {
		      console.log('Geocoder failed due to: ' + status);
		    }
		  });

////////console.log(addressCheckin);
		console.log($('#infobulle-checkin'));
		
	    
	  }
	},

	//get the geolocation datas and check if the skater is in paris or not
	findPosition:function(position) { 
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
	          mapObj.findOnGoogleMaps();
	        //}
	      } else {
	        console.log('No results found');
	      }
	    } else {
	      console.log('Geocoder failed due to: ' + status);
	    }
	  });
	},

	findOnGoogleMaps:function() {
	    currentPos = new google.maps.LatLng(posLatitude, posLongitude);
	    map.setZoom(15);
	    map.setCenter(currentPos);
	    var markerPos = new google.maps.Marker({
	        position: currentPos,
	        map: map,
	        title: "Votre position"
	    });
	    infowindowCI.open(map, markerPos);
	},


	//get the location via the browser
	findLocation:function() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(mapObj.findPosition, mapObj.handleError);
	    } else {
	        updateStatus("Votre navigateur ne supporte pas la géolocalisation, indiquez votre adresse dans le champs ci-dessus.");
	    }
	},


	find : function(address){
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({"address":address},function(data,status){
			if(status=='OK'){
				var destPos=data[0].geometry.location;
				console.log(mapObj.params.mapDiv);
				map.setZoom(15);
				map.setCenter(destPos);

				//var marker = new google.maps.Marker({position: destPos,map: localize.map});
				//localize.params.found.call(this,destPos);
			}
			else{
				//localize.params.found.call(this,null);
			}
		});
		
	},

	//Add the checkin datas in the database
	addCheckin:function() {
	    var comment = document.forms["add_comment"].elements[0].value;
	    var url = "add_checkin.php?lat=" + posLatitude + "&lng=" + posLongitude + "&comm=" + comment;
	    var request = $.ajax({
	      url: url,
	    });
	     
	    request.done(function(  ) {
	      $( "#textCheckin" ).html( "C'est fait !" );
	      $( "#firstHeading" ).html( "Check in enregistré !" );
	    });
	     
	    request.fail(function( jqXHR, textStatus ) {
	      console.log( "Request failed: " + textStatus );
	      $( "#textCheckin" ).html( "oops!" );
	      $( "#firstHeading" ).html( "Il semble qu'il y a un problème" );
	    });
	    return false;
	},
	  
	windowPlanCheckin:function() {
		var formPlan = '';
		var windowPlan = new google.maps.InfoWindow({
	      content: formPlan
	    });
		windowPlan.open(map, markerPlan);
		windowPlan.setContent('<div id="plan_checkin">'+
		    '<form name="planPlace" id="planPlace" onsubmit="return mapObj.planCheckin();"><div id="errors" ></div><br>'+
		      '<label for="day">Jour </label><input type="text" name="day" id="day">'+
		      '<label for="time">Heure </label><input type="time" name="time" id="time" value="hh:mm">'+
		      '<label for="comment">Commentaire </label><input type="text" name="comment" id="comment">'+
		      '<input type="submit" value="OK">'+
		    '</form>'+
		  '</div>');
		$( "#day" ).datepicker({ dateFormat: 'dd/mm/yy' });
	},

	// Add a marker where the click is
	addMarkerPlan : function(location) {
	  markerPlan = new google.maps.Marker({
	    position: location,
	    map: map
	  });
	},

	removeMarkerPlan : function(){
		markerPlan.setMap(null);
	},

	planCheckin:function() {
		var datePlan = $('#day').val();
		var timePlan = $('#time').val();
		var commentPlan = $('#comment').val();
		var d=datePlan.split("/");
		var nd=new Date(d[2], d[1] - 1, d[0]);
		var dd = nd.getDate();
		var mm = nd.getMonth() + 1; 
		var yyyy = nd.getFullYear();
		var dateFormated = yyyy + "-" + mm + "-" + dd;

		var url = "plan_checkin.php?lat=" + latPlan + "&lng=" + lngPlan +"&day=" + dateFormated + "&time=" + timePlan+ "&c=" + commentPlan;
	    var request = $.ajax({
	      url: url,
	      //type: "POST",
	    });
	     
	    request.done(function(  ) {
	      $( "#plan_checkin" ).html( "Evenement planifié !" );
	    });
	     
	    request.fail(function( jqXHR, textStatus ) {
	      console.log( "Request failed: " + textStatus );
	      $( "#plan_checkin" ).append( "oops! il y a eu une erreur" );
	    });
	    return false;
	},
	

}
