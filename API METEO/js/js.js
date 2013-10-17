// JavaScript Document

$(document).ready( function() {
	
	// Variables

	
	var _xml						= null;

	
	// Chargement du XML
	
	$.ajax({
		type: 'POST',
		url: 'xml/weather.xml',
		//url:'http://api.openweathermap.org/data/2.5/weather?q=Paris&mode=xml,'
		dataType: 'xml',
		success: Init,
		error: AJAX_erreur
	});
	
	
	//
	function Init(p_xml) {
		
		console.log('---------- function Construction_decor');
		console.log(p_xml);
		console.log('----------');
		
		// Stockage du XML
		_xml						= p_xml;
		console.log('Météo chargée');
		Decor();
		
	};
	//
	function Decor() {
		
		console.log($(_xml).find('city').attr('name'), $(_xml).find('temperature').attr('value')/-272.15 );
		// console.log($(_xml).find('niveau').eq(0).find('decor').length + ' lignes');
		// console.log($(_xml).find('niveau').eq(0).find('decor').eq(0).attr('descr').length + ' colonnes');
		
	};
	//
	function AJAX_erreur(xhr, ajaxOptions, thrownError) {
		console.log('----- AJAX_erreur : ');
		console.log('xhr = ' + xhr.status);
		console.log(xhr.responseText);
		console.log('ajaxOptions = ' + ajaxOptions);
		console.log('thrownError = ' + thrownError);
	};
	//
});