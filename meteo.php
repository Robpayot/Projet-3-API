<?php

// Get XML data from source
$feed = file_get_contents("http://weather.yahooapis.com/forecastrss?w=615702&u=c");

// Check to ensure the feed exists
if(!$feed){
die('Weather not found! Check feed URL');
}
$xml = new SimpleXMLElement($feed);

$code=false;

foreach($xml->channel->item->children('yweather', TRUE) as $noeud => $b) {
	foreach($xml->channel->item->children('yweather', TRUE)->$noeud->attributes() as $attribut => $valeur){
	if($attribut=='temp'){
		$temperature=$valeur."°C";
	}
	if ($attribut=='code' && !$code){
		$codeImg=$valeur;
			$code=true;
	}
    	

	
}
}
?>


