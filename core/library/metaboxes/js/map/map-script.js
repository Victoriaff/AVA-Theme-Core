var default_lat  = spotter_maps_metabox_vars.default_lat;
var default_lng  = spotter_maps_metabox_vars.default_lng;
var default_zoom = parseInt(spotter_maps_metabox_vars.default_zoom);
var map_title 	 = spotter_maps_metabox_vars.map_title;
var mapStyles = [{featureType:'water',elementType:'all',stylers:[{hue:'#d7ebef'},{saturation:-5},{lightness:54},{visibility:'on'}]},{featureType:'landscape',elementType:'all',stylers:[{hue:'#eceae6'},{saturation:-49},{lightness:22},{visibility:'on'}]},{featureType:'poi.park',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},{featureType:'poi.medical',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-80},{lightness:-2},{visibility:'on'}]},{featureType:'poi.school',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-91},{lightness:-7},{visibility:'on'}]},{featureType:'landscape.natural',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-71},{lightness:-18},{visibility:'on'}]},{featureType:'road.highway',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:60},{visibility:'on'}]},{featureType:'poi',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-81},{lightness:34},{visibility:'on'}]},{featureType:'road.arterial',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:37},{visibility:'on'}]},{featureType:'transit',elementType:'geometry',stylers:[{hue:'#c8c6c3'},{saturation:4},{lightness:10},{visibility:'on'}]}];

(function ($) {
 	$('.cmb-type-spotter_custom_map').each(function() {
		var searchInput = $('.map-search', this).get(0);
		var mapCanvas   = $('#admin-map', this).get(0);
		var latitude    = $('.lat',  this);
		var longitude   = $('.lng', this);
		var latLng      = new google.maps.LatLng(default_lat, default_lng);
		var zoom        = default_zoom;

		// Map
		if(latitude.val().length > 0 && longitude.val().length > 0) {
			latLng = new google.maps.LatLng(latitude.val(), longitude.val());
			zoom   = default_zoom;
		}
		
		var mapOptions = { 
							center: latLng,
							zoom: zoom,
							zoomControl: true,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							styles : mapStyles
						};
		var map = new google.maps.Map(mapCanvas, mapOptions);

		// Marker
		var markerOptions = {
						map: map,
						draggable: true,
						title: map_title
		};
		
		
		var marker = new google.maps.Marker(markerOptions);

		if(latitude.val().length > 0 && longitude.val().length > 0) {
			marker.setPosition(latLng);
		}

		google.maps.event.addListener(marker, 'drag', function() {
			latitude.val(marker.getPosition().lat());
			longitude.val(marker.getPosition().lng());
		});

		// Search
		var autocomplete = new google.maps.places.Autocomplete(searchInput);
		autocomplete.bindTo('bounds', map);

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				return;
			}
			
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17); 
			}
	
			marker.setPosition(place.geometry.location);
			latitude.val(marker.getPosition().lat());
			longitude.val(marker.getPosition().lng());
			marker.setVisible(true);
	
		});

		$(searchInput).keypress(function(e) {
			if(e.keyCode == 13) {
				e.preventDefault();
			}
		});

		// Resize map when meta box is opened
		postboxes.pbshow = function() {
			google.maps.event.trigger(map, "resize");
			map.setCenter(latLng);
		};
    });

}(jQuery));