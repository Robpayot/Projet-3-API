var map; 
var geocoder;

var initializeMap;
var latLng;

var debut; //stock the date of the beginning of a checkin displayed on the map
var fin; // ^ the end
var pseudo; //stock the pseudo of the displayed checkin's user

//get the current date and hour
var dateTS= new Date().getTime(); 
var dateNow = new Date(dateTS);
var month = dateNow.getMonth()+1;
var date = dateNow.getFullYear() + "-" + month + "-" +  dateNow.getDate();
var hour = dateNow.getHours() + ":" + dateNow.getMinutes();

var markerChekin; //marker of a checkin displayed on the map
var indiceMarker;
var markers = []; //Array with all the markers to display on the map
var posLatitude, posLongitude; //coordinates of the user's position
var addressLocation; //stock the address found by the geocoder
var markerPlan; //marker of the place the user want to plan a checkin
var latPlan, lngPlan; //coordinates of a checkin planned



var mapObj = {

	defaults : {
		mapDiv : '#map-canvas',
		styles : [],
		skateparks : new Array(),
		minZoomLvl : 12,
		checkinButton : '#find',

		initializedMap : function () {},
		gotCheckin : function() {},
		planedCheckin : function(){},
		addedCheckin :function(){},
	},


	init : function(options){
		this.params=$.extend(this.defaults,options);
	},

	initializeMap : function() {
		//console.log('initialisation de la map');
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


	    // Limit of the map 
	    var strictBounds = new google.maps.LatLngBounds(
	      new google.maps.LatLng(48.816811, 2.251114),
	      new google.maps.LatLng(48.902643, 2.408699)
	    );

	    // listen for the dragend event
	    google.maps.event.addListener(map, 'dragend', function () {
	      if (strictBounds.contains(map.getCenter())) return;
	      // out of bounds, move the map back within the bounds
	      var c = map.getCenter(), //get coords of the center of the map
	          x = c.lng(), //get lng of the center
	          y = c.lat(), //get lat
	          maxX = strictBounds.getNorthEast().lng(), //lng top right corner of the map
	          maxY = strictBounds.getNorthEast().lat(), //lat''''''''
	          minX = strictBounds.getSouthWest().lng(), //lng bottom left corner of the map
	          minY = strictBounds.getSouthWest().lat(); //lat''''''''
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
	        icon:'imgs/icons/skatepark.png',
	        title: skatepark[0],
	        zIndex: skatepark[3]
	    });
	    var skateparkName = "";
	    var infoSkatepark = new InfoBubble({
			map: map,
			content: '<div class="noscrollbar">'+skatepark[0]+'</div>',  
			//position: event.latLng,  
			shadowStyle: 0, 
			padding: 10,  
			backgroundColor: '#ffffff',  
			borderRadius: 0, 
			arrowSize: 10, 
			borderWidth: 0,  
			borderColor: '#009EE0', 
			disableAutoPan: true, 
			hideCloseButton: false, 
			arrowPosition: 50,  
			arrowStyle: 0, 
			disableAnimation: false, 
			maxWidth :   320 
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
	    var locationsData;
	    var pseudo;
	    var count;
	    $.get( url, function( data ) {
	      locationsData=JSON.parse(data);
	      count = locationsData.json.length;
	      mapObj.params.gotCheckin.call(this,locationsData,count);
	    });
	     
	},

	changeDate:function() {
	  date = document.getElementById('date').value;
	  console.log(date);
	  mapObj.deleteMarkers();
	  mapObj.getCheckin();
	},

	changeHour:function() {
	  hour = document.getElementById('hour').value;
	  console.log(hour);
	  mapObj.deleteMarkers();
	  mapObj.getCheckin();
	},

	// Add a marker to the map and push to the array.
	addMarker : function(location,url) {
	  markerChekin = new google.maps.Marker({
	    position: location,
	    map: map,
	    icon:url,
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
	setMarkersCheckin: function(map,locations,pseudo) {
	  //define time variables
	  var timeChoosen=date+' '+hour;
	  debut=locations.date_begin;
	  fin=locations.date_end;

	  //date formatted to display them in the infobubble
	  var begin=new Date(locations.date_begin);
	  var dayBegin=begin.getDate();
	  var monthBegin=begin.getMonth()+1;
	  var hourBegin=begin.getHours();
	  var minuteBegin=begin.getMinutes();
	  var timeBegin=dayBegin+'/'+monthBegin+' <br>'+hourBegin+':'+minuteBegin;
	  var end=new Date(locations.date_end);
	  var hourEnd=end.getHours();
	  var minuteEnd=end.getMinutes();
	  var timeEnd=hourEnd+':'+minuteEnd;
	  //and the pseudo & comment
	  var pseudo=locations.pseudo;
	  var comment = locations.comment;

	  //get LatLng object from the coordinates of the checkin
	  var myLatLng = new google.maps.LatLng(locations.lat, locations.lng);

	  if((debut<=timeChoosen) && (timeChoosen<=fin)) {//if the checkin is happening right now
	    var checkinInfo = ''; //initialize the infobubble content

	    //initialize the var where the infobubble will be
		var infobulle = new InfoBubble({
			map: map,
			content: checkinInfo,  
			position: event.latLng,  
			shadowStyle: 0, 
			padding: 0,  
			backgroundColor: 'rgb(255,255,255)',  
			borderRadius: 0, 
			arrowSize: 10, 
			borderWidth: 0,  
			borderColor: '#009EE0', 
			disableAutoPan: true, 
			hideCloseButton: false, 
			arrowPosition: 50,  
			arrowStyle: 0, 
			disableAnimation: false, 
			maxWidth :   150 
		});

		//ajax to know if is friend or not
		var url='ListeAmis.php?iduser_checkin='+locations.id_user;
		$.get( url, function( data ) {
	      var isFriend =data;
	      //if is a friend, it's the blue icon
	      if(isFriend==1) {
		  	mapObj.addMarker(myLatLng,'imgs/icons/checkinamis.png');
		  } else if(isFriend==2){ //if  it's me it's the red icon
		  	mapObj.addMarker(myLatLng,'imgs/icons/checkinme.png');
		  } else { //if it's someone i don't know, it's the grey icon
		  	mapObj.addMarker(myLatLng,'imgs/icons/checkin.png');
	      }
	      if(isFriend==1 || isFriend==2){ //if it's a firend or if it's me, i can see the information about the checkin
	      google.maps.event.addListener(markerChekin, 'click', (function() {
	      for (var j=0;j<markers.length; j++){
	          if((this.position.ob==markers[j].position.ob)&&(this.position.pb==markers[j].position.pb)){
	            indiceMarker=j;
	          }
	        }
	        infobulle.open(map,markers[indiceMarker]);
	      }));
	  	  }

	    //determine what is the address corresponding to the coordinates
	    var addressCheckin;
	    geocoder.geocode({'latLng': myLatLng}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      if (results[1]) { //if success, then display the infobubble
		        addressCheckin = results[1].formatted_address;
		        infobulle.setContent('<div id="pseudo-checkin"><div class="categ blue" style="margin-right:10px;"></div>'+pseudo+'</div>'+
	                      '<div id="content-infocheckin"><span id="addressCheckin"><img src="imgs/icons/geomark.png" alt="" style="margin-right:5px" />'+addressCheckin+'</span><br>'+
	                      '<span class="dateCheckin"><img src="imgs/icons/time.png" alt="" style="margin-right:5px"  />Le '+timeBegin+' à '+timeEnd+'</span><br>'+
	                      '<span><img src="imgs/icons/bubble.png" alt="" style="margin-right:5px"  /> "'+comment+'"</span></div>');
		      } else {
		        console.log('No results found');
		      }
		    } else {
		      console.log('Geocoder failed due to: ' + status);
		    }
		  });
	    });
	  }
	},

	


	find : function(address){
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({"address":address},function(data,status){
			if(status=='OK'){
				var destPos=data[0].geometry.location;
				map.setZoom(15);
				map.setCenter(destPos);
			}
			else{
				console.log('Erreur du geocoder');
			}
		});
		
	},

	
	

}

