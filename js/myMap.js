mapObj.init({
	mapDiv: 'map-canvas',
	styles: mapStyles,
	skateparks: [ //skateparks list
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
	],
	minZoomLvl: 13,
	checkinButton: '#find',
	initializedMap: function () {},
	gotCheckin: function (locationsData, count) {
		for (var i = 0; i < count; i++) {
			mapObj.setMarkersCheckin(map, locationsData.json[i]);
		}
	},
	planedCheckin: function (locationsData, count) {
		$("#list-checkins").empty().fadeIn(1000);
		profil.evenement();
	},
	addedCheckin: function (locationsData, count) {
		$("#list-checkins").empty().fadeIn(1000);
		profil.evenement();
	},
});


google.maps.event.addDomListener(window, 'load', mapObj.initializeMap());
mapObj.setMarkers(map, mapObj.params.skateparks); //Display the skateparks' markers
mapObj.getCheckin(); //Get the information about the skaters and display the skaters' markers on the map

$(mapObj.params.checkinButton).on('click', function (e) {
	//e.preventDefault();
	mapObj.findLocation();
});

$('#date').val(date);
$('#hour').val(hour);

//$('#date').on('change',mapObj.changeDate());
//$('#hour').on('change',mapObj.changeHour());
//$('#find').on('click',mapObj.findLocation());

$("#geocoder").submit(function (e) {
	e.preventDefault();
	var address = $("#address").val();
	mapObj.find(address);
});

var mapStyles = [ //colors of the map
	{
		"featureType": "administrative.country",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "poi.business",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "poi.government",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "landscape.man_made",
		"elementType": "geometry",
		"stylers": [{
			"visibility": "on"
		}, {
			"lightness": 34
		}]
	}, {
		"featureType": "poi.park",
		"stylers": [{
			"visibility": "on"
		}]
	}, {
		"featureType": "poi.place_of_worship",
		"stylers": [{
			"visibility": "on"
		}]
	}, {
		"featureType": "poi.school",
		"stylers": [{
			"visibility": "on"
		}]
	}, {
		"featureType": "poi.sports_complex",
		"stylers": [{
			"visibility": "on"
		}]
	}, {
		"featureType": "transit.line",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "transit.station.airport",
		"stylers": [{
			"visibility": "off"
		}]
	}, {}, {
		"featureType": "road.local",
		"stylers": [{
			"visibility": "on"
		}, {
			"lightness": 47
		}]
	}, {
		"featureType": "poi.park",
		"stylers": [{
			"hue": "#66ff00"
		}, {
			"lightness": -12
		}, {
			"saturation": 19
		}]
	}, {
		"featureType": "water",
		"stylers": [{
			"lightness": -7
		}]
	}, {
		"elementType": "geometry"
	}
]