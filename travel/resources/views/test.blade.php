<!DOCTYPE html>
<html>
<head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>

    <!-- jQuery -->
    <script   src="https://code.jquery.com/jquery-1.12.3.min.js"
              integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
              crossorigin="anonymous">

    </script>
</head>
<body>
<div id="floating-panel">
    <input id="address" type="textbox" value="Sydney, NSW">
    <input id="submit" type="button" value="Geocode">
</div>
<div id="results"></div>
<div id="map"></div>
<script>
    var map;
    var marker;


    function initMap() {
        var centerPosition = new google.maps.LatLng(38.713107, -90.42984);
        var options = {
            zoom: 6,
            center: centerPosition,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($('#map')[0], options);


        var geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function () {
            geocodeAddress(geocoder, map);
        });
       /* google.maps.event.addListener(map, 'click', function (evt) {
            placeMarker(evt.latLng);
        });*/
    }
    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {

                placeMarker(results[0].geometry.location);
                //placeMarker(results[0].geometry.location, resultsMap);
                //resultsMap.setCenter(results[0].geometry.location);


                /*markers.push(new google.maps.Marker({
                 position: results[0].geometry.location,
                 map: resultsMap
                 }));*/

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    function placeMarker(location) {
        if (marker) {
            //if marker already was created change positon
            marker.setPosition(location);
        } else {
            //create a marker
            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true
            });
        }
        map.setCenter(marker.getPosition());
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap">
</script>
</body>
</html>