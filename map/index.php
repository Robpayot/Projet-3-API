<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->

    <title>Test GMAPS</title>
    <meta name="description" content="">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL6jbConOc2cMBNepwDNA0l_lqrNOaRPI&sensor=true"></script><!-- API Google Maps-->

    <script type="text/javascript" src="map.js"></script>


</head>

<body>


    <p><input type="button" id="find" onClick="findLocation()" value="check in"> </p>
    <p id="statut"></p>
    <div id="map-canvas"/>

</body>
</html>