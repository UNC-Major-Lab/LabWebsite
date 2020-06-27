function initialize() {

    var cancerresearch = new google.maps.LatLng(38.634519,-90.2629874);
    var mapOptions = {
        center: cancerresearch,
        zoom: 16,
	disableDefaultUI: true,
	panControl: false,
	zoomControl: true,
	mapTypeControl: false,
	scaleControl: false,
	streetViewControl: true,
	overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
				  mapOptions);

    var marker = new google.maps.Marker({
	position: cancerresearch,
	title: "Major Lab!"
    });

    var infowindow = new google.maps.InfoWindow({
	content: "Major Lab!"
    });

    marker.setMap(map);

    google.maps.event.addListener(marker, 'click', function() {
	infowindow.open(map,marker);
    });
}