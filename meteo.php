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

switch ($codeImg) {
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
	case 9:
	case 11:
	case 12:
	case 17:
	case 18:
	case 39:
	case 40:
	case 45:
		$codeImg=1;
		break;
	case 7:
	case 8:
	case 10:
	case 13:
	case 14:
	case 15:
	case 16:
	case 41:
	case 42:
	case 43:
	case 46:
		$codeImg=6;
		break;
	case 19:
	case 20:
	case 21:
	case 22:
	case 23:
	case 24:
	case 25:
	case 26:
		$codeImg=4;
		break;
	case 35:
	case 37:
	case 38:
	case 47:
		$codeImg=2;
		break;
	case 28:
	case 29:
	case 30:
	case 44:
		$codeImg=3;
		break;	
	case 31:
	case 33:
	case 36:
		$codeImg=5;
		break;	
	case 27:
	case 28:
	case 30:
	case 32:
	case 27:
		$codeImg=7;
		break;	
	
}


?>


