<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBhFF24SOwCt4JgrzQY6T9Wv7oEjzUXh38&sensor=false">
    </script>
    <script type="text/javascript">
        var geocoder;
        var map;
        function initialize() {
			
			var roadAtlasStyles = [
									  {
										  "featureType": "road.highway",
										  "elementType": "geometry",
										  "stylers": [
											{ "saturation": -100 },
											{ "lightness": -8 },
											{ "gamma": 1.18 }
										  ]
									  }, {
										  "featureType": "road.arterial",
										  "elementType": "geometry",
										  "stylers": [
											{ "saturation": -100 },
											{ "gamma": 1 },
											{ "lightness": -24 }
										  ]
									  }, {
										  "featureType": "poi",
										  "elementType": "geometry",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "administrative",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "transit",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "water",
										  "elementType": "geometry.fill",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "road",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "administrative",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "landscape",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
										  "featureType": "poi",
										  "stylers": [
											{ "saturation": -100 }
										  ]
									  }, {
									  }
								]
			
			
            geocoder = new google.maps.Geocoder();
            //var latlng = new google.maps.LatLng(-37.753344,144.980621);
            var mapOptions = {
                zoom: 14,
                //center: latlng
				 mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
                }
            }
            var infowindow = new google.maps.InfoWindow({
                content: '<b>90 Degree</b>'
            });

            var address = "67 North St Richmond, VIC 3121 Australia";
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        icon: '<?=base_url();?>assets/frontend/images/mapMarker.png'
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map,marker);
                    });

                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
            //map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
			
			map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            var styledMapOptions = {
                
            };

            var usRoadMapType = new google.maps.StyledMapType(
                roadAtlasStyles, styledMapOptions);

            map.mapTypes.set('usroadatlas', usRoadMapType);
            map.setMapTypeId('usroadatlas');
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
    
    
</head>
<body>
    <div id="map-canvas"></div>
</body>
</html>
