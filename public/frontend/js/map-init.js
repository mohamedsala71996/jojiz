// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);

function init() {
    var mapOptions = {
        zoom: 12,
        scrollwheel: false,
        center: new google.maps.LatLng(37.393322, -122.023780),
    };
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(37.393322, -122.023780),
        map: map,
    });
}