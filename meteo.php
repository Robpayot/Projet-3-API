<?php

// Get XML data from source
$feed = file_get_contents("http://weather.yahooapis.com/forecastrss?w=615702&u=c");

// Check to ensure the feed exists
if(!$feed){
die('Weather not found! Check feed URL');
}
$xml = new SimpleXMLElement($feed);

$code=false;
//parcours dur XML
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
//Image personnalisée selon le code image de yahoo
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
	case 27:
	case 29:
		$codeImg=4;
		break;
	case 35:
	case 37:
	case 38:
	case 47:
		$codeImg=2;
		break;
	case 28:
	case 30:
	case 44:
		$codeImg=3;
		break;	
	case 32:
	case 34:
	case 36:
		$codeImg=5;
		break;	
	case 31:
	case 33:
		$codeImg=7;
		break;	
	
}

/*
Pluie :  Yahoo : 1 / 2 / 3 / 4 / 5 / 6 / 9 / 11 / 12 / 17 / 18 / 39 / 40 / 45
Icon => 1.png

Neige : Yahoo : 7 / 8 / 10 / 13 / 14 / 15 / 16 / 41 / 42 / 43 / 46
Icon => 6.png
	
Nuage : Yahoo : 19 / 20 / 21 / 22 / 23 / 24 / 25 / 26 /27/29
  Icon => 4.png

Orage : Yahoo : 35 / 37 / 38 / 47 
Icon => 2.png

Nuage+soleil : Yahoo : 28 /  30 / 44
Icon => 3.png

Soleil : Yahoo :  32/36/34
Icon => 5.png

Lune : Yahoo :   31 /  33 
Icon => 7.png
*/


?>


