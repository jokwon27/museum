<style type="text/css">
  #map-canvas { height: 550px; }
</style>
<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script> 
<script type="text/javascript">
	var thecenter = new google.maps.LatLng(-7.783069238887897,110.36760125309229);
	var poly;
  var markers = [];
  var map = {};

	function initialize() {
		var mapOptions = {
		  center: thecenter,
		  zoom: 16	
		};
		map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);

		var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

	}
	google.maps.event.addDomListener(window, 'load', initialize);

	function addLatLngEdit(lat, longi) {
	  var path = poly.getPath();
	  path.push(new google.maps.LatLng(lat,longi));
	}

	function draw_path_shelter(id_jalur){
      $.ajax({
            type : 'GET',
            url: '<?= base_url("trans_jogja/get_rute_trans_jogja") ?>/'+id_jalur,
            dataType: 'json',
            cache: false,
            success: function(data) {
                
                if (data.jalur.length > 0) {
                  $.each(data.jalur, function(i, v){
                      addLatLngEdit(v.d, v.e)
                  });
                }
                
                $('#judul_jalur').html(data.detail.nama);
                $('#detail_jalur').html(data.detail.rute);
            }
        });
    }

    function placeMarker(location,id, judul) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: judul,
            id_shelter: id,
            icon : '<?= base_url("assets/img/bus.png") ?>'
        });

        markers.push(marker);
    }

    function get_all_shelter(){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("trans_jogja/get_all_shelter") ?>/',
            dataType: 'json',
            cache: false,
            success: function(data) {
                $.each(data, function(i,v){
                    placeMarker(new google.maps.LatLng(v.latitude,v.longitude),v.id, 'Shelter '+v.nama);
                });

            }
        });
    }

    function delete_all_map(){
        $('#judul_jalur, #detail_jalur').html('');
        if (poly !== null) {poly.setMap(null);};
            var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map)
    }

    $(function(){
      get_all_shelter()
    	
    });

    function show_jalur(obj, id){
      delete_all_map();
      $('.list_jalur').removeClass('active');
      $(obj).addClass('active');
      draw_path_shelter(id);

    }
</script>


<title><?= $title ?></title>
<div class="row">
  <div class="col-lg-8">
    <div id="map-canvas" class="col-lg-12"></div>
    <div class="row"><br/><br/></div>
    <h3>Nama Jalur : <span id="judul_jalur"></span></h3>
    <p class="" style="align:justify" id="detail_jalur"></p>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
  </div>
  
  
  <div class="col-lg-4">
    <div class="well">
      <h4>List Jalur Trans Jogja</h4>
      <ul class="nav nav-pills nav-stacked">
        <?php foreach ($jalur as $key => $value):?>
        <li style="cursor:pointer;" class="list_jalur" onclick="show_jalur(this, <?= $value->id ?>)"><a><?= $value->nama ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div><!-- /well -->

</div>
