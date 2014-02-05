<title><?= $museum->nama ?></title>
<div class="row">
	<div class="col-lg-8">
	    <h1><?= $museum->nama ?></h1>
	    <hr>
	    <img src="<?= base_url('image_upload/tumbnail_museum').'/'.$museum->image ?>" />
	    <br/><br/>
	    <p><span class="fa fa-building-o"></span> Alamat : <?= $museum->alamat ?></p>
	    <p><span class="fa fa-map-marker"></span> Longitude : <?= $museum->longitude ?></p>
	    <p><span class="fa fa-map-marker"></span> Latitude : <?= $museum->latitude ?></p>
	    

	    <hr>
	    <p>
	        <?= $museum->keterangan ?>
	    </p>
	</div>

	<div class="col-lg-4">
		<div class="well">
		  <h4>Panel</h4>
		  
		</div><!-- /well -->

	</div>

</div>