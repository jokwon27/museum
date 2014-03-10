<style type="text/css">
  #map-canvas { height: 550px; }
</style>
<link href="<?= base_url('assets/css/jquery.autocomplete.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/jquery.autocomplete.js') ?>"></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script> -->
<script type="text/javascript">
   var map;
   var markers = [];

    function initialize() {
      var myOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById('map-canvas'),
          myOptions);

      // Try HTML5 geolocation
      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = new google.maps.LatLng(position.coords.latitude,
                                           position.coords.longitude);

        

          placeMarker(pos, 'Lokasi Anda');

          map.setCenter(pos);
        }, function() {
          handleNoGeolocation(true);
        });
      } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
      }
    }

    function handleNoGeolocation(errorFlag) {
      if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
      } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
      }

      var options = {
        map: map,
        position: new google.maps.LatLng(60, 105),
        content: content
      };

      var infowindow = new google.maps.InfoWindow(options);
      map.setCenter(options.position);
    }

    function placeMarker(location, judul) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: judul
        });

        markers.push(marker);
    }

    //google.maps.event.addDomListener(window, 'load', initialize);

    $(function(){
      $('#museum').autocomplete("<?= base_url('autocomplete/get_museum') ?>",
        {
            parse: function(data){
                var parsed = [];
                for (var i=0; i < data.length; i++) {
                    parsed[i] = {
                        data: data[i],
                        value: data[i].nama // nama field yang dicari
                    };
                }
                $("input[name=id_museum]").val('');
                
                return parsed;
            },
            formatItem: function(data,i,max){
                var str = '<div class=result>'+data.nama+'<br/> '+data.alamat+'</div>';
                return str;
            },
            width: 400, // panjang tampilan pencarian autocomplete yang akan muncul di bawah textbox pencarian
            dataType: 'json' // tipe data yang diterima oleh library ini disetup sebagai JSON
        }).result(
        function(event,data,formated){
            $(this).val(data.nama);
            $("input[name=id_museum]").val(data.id);
            
        });
    });
  </script>


<title><?= $title ?></title>
<div class="row">
  <div id="map-canvas" class="col-lg-8"></div>
  
  <div class="col-lg-4" >
    <div class="well" style="min-height:500px;">
      <h4>Pencarian Rute Museum</h4>
      <br/>
      <strong>Pilih Museum</strong>
      
      <?= form_input('museum','','class="form-control" id=museum')?>
      <input type="hidden" id="id_museum"/>
      <br/>
      <button class="btn btn-primary"><i class="fa fa-search"></i> Cari Rute</button>
      <hr style="border-bottom:1px solid #999;" /> 
       
      
    </div><!-- /well -->

</div>