<style type="text/css">
  #map-canvas { width:90%;height: 400px; }
</style>
 <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
    <script type="text/javascript">
// This example creates an interactive map which constructs a
// polyline based on user clicks. Note that the polyline only appears
// once its path property contains two LatLng coordinates.

var poly;
var map;

function initialize() {
  var mapOptions = {
    zoom: 14,
    // Center the map on Chicago, USA.
    center: new google.maps.LatLng(-7.782772,110.366922)
  };

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var polyOptions = {
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  };
  poly = new google.maps.Polyline(polyOptions);
  poly.setMap(map);

  // Add a listener for the click event
  google.maps.event.addListener(map, 'click', addLatLng);
}

/**
 * Handles click events on a map, and adds a new point to the Polyline.
 * @param {google.maps.MouseEvent} event
 */
function addLatLng(event) {

  var path = poly.getPath();
  console.log(JSON.stringify(path.getArray()))

  // Because path is an MVCArray, we can simply append a new coordinate
  // and it will automatically appear.
  path.push(event.latLng);

  // Add a new marker at the new plotted point on the polyline.
  var marker = new google.maps.Marker({
    position: event.latLng,
    title: '#' + path.getLength(),
    map: map
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

 </script>

<div id="map-canvas"></div>
