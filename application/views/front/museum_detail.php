<style type="text/css">
  #map-canvas { width:300px;height: 250px; }
</style>
<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false">
</script>
<script type="text/javascript">
	var latlong = new google.maps.LatLng(<?= $museum->latitude ?>, <?= $museum->longitude ?>);
  function initialize() {
    var mapOptions = {
      center: latlong,
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
    var marker = new google.maps.Marker({
	    position: latlong,
	    title:"<?= $museum->nama ?>"
	});
	marker.setMap(map);
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>


<title><?= $museum->nama ?></title>
<div class="row">
	<div class="col-lg-8">
	    <h1><i class="fa fa-building-o"></i> <?= $museum->nama ?></h1>
	    <hr>
	    
	    <div style="float:left;margin-right:100px">
	    	<img src="<?= base_url('image_upload/tumbnail_museum').'/'.$museum->image ?>" width="300px" height="250px" />
	   	</div>

		<div id="map-canvas"></div>		    

	    <br/>
	    <hr>
	    <p><span class="fa fa-building-o"></span> Alamat : <?= $museum->alamat ?></p>
	    <p><span class="fa fa-map-marker"></span> Longitude : <?= $museum->longitude ?></p>
	    <p><span class="fa fa-map-marker"></span> Latitude : <?= $museum->latitude ?></p>
	    

	    <hr>
	    <p>
	        <?= $museum->keterangan ?>
	    </p>
	    <iframe width="560" height="315" src="//www.youtube.com/embed/vgMA1lxd5xw" frameborder="0" allowfullscreen></iframe>
	</div>

	<div class="col-lg-4">
		<div class="well">
		  <h4>Panel</h4>
		  
		</div><!-- /well -->

	</div>

</div>