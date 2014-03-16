<style type="text/css">
  #map-canvas { width:300px;height: 250px; }
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gallery/css/bootstrap-image-gallery.min.css">
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
	    
	    <?php if($museum->link_youtube !== null): ?>
	    <br/>
	    <hr/>
	    <iframe width="560" height="315" src="<?= $museum->link_youtube ?>" frameborder="0" allowfullscreen></iframe>
		<?php endif; ?>
		<hr/>

		<?php if(($museum->folder_gallery !== null) & (sizeof($gallery) > 0)): ?>
		<h4>Gallery</h4>
		<div id="links">
			<?php foreach ($gallery as $key => $value): ?>
		    <a href="<?= base_url() ?>image_upload/gallery/<?= $museum->folder_gallery ?>/<?= $value->url ?>" title="<?= $value->judul ?>" data-gallery>
		        <img src="<?= base_url() ?>image_upload/gallery/<?= $museum->folder_gallery ?>/<?= $value->url ?>" alt="<?= $value->judul ?>" width="100" width="100">
		    </a>
		<?php endforeach; ?>
		</div>
		<div id="blueimp-gallery" class="blueimp-gallery">
		    <!-- The container for the modal slides -->
		    <div class="slides"></div>
		    <!-- Controls for the borderless lightbox -->
		    <h3 class="title"></h3>
		    <a class="prev">‹</a>
		    <a class="next">›</a>
		    <a class="close">×</a>
		    <a class="play-pause"></a>
		    <ol class="indicator"></ol>
		    <!-- The modal dialog, which will be used to wrap the lightbox content -->
		    <div class="modal fade">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" aria-hidden="true">&times;</button>
		                    <h4 class="modal-title"></h4>
		                </div>
		                <div class="modal-body next"></div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default pull-left prev">
		                        <i class="glyphicon glyphicon-chevron-left"></i>
		                        Previous
		                    </button>
		                    <button type="button" class="btn btn-primary next">
		                        Next
		                        <i class="glyphicon glyphicon-chevron-right"></i>
		                    </button>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php endif; ?>

	</div>

	<div class="col-lg-4">
		<div class="well">
		  <h4>Panel</h4>
		  
		</div><!-- /well -->

	</div>

</div>
<script src="<?= base_url() ?>assets/gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?= base_url() ?>assets/gallery/js/bootstrap-image-gallery.min.js"></script>