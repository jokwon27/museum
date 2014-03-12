<style type="text/css">
  #map-canvas { height: 550px; }
</style>
<link href="<?= base_url('assets/css/jquery.autocomplete.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/jquery.autocomplete.js') ?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
<script type="text/javascript">
    var mylat = -7.774735;
    var mylong = 110.369164;

    var myposition = new google.maps.LatLng(mylat, mylong);
    var map;
    var markers = [];
    var markers_shelter = [];

    function initialize() {
      var myOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById('map-canvas'),
          myOptions);

      /*
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
      */

      placeMarker(myposition, 'Lokasi Anda');

      map.setCenter(myposition);
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

    function shelterMarker(id, location, judul ) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: judul,
            id_shelter: id,
            icon : '<?= base_url("assets/img/bus.png") ?>'
        });

        markers_shelter.push(marker);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    $(function(){
      $('#cari_rute').click(function(){
        var id_sm = $('#id_shelter_museum').val();
        var id_su = $('#id_shelter_user').val();
        if(id_su == ''){
          //message_custom('notice', 'Peringatan', 'Silahkan cari shelter terdekat dengan anda' , '#user_dekat')
          alert('Silahkan cari shelter terdekat dengan anda');
          return false;
        }

        if(id_sm == ''){
          alert('Silahkan pilih museum yang akan dicari');
          //message_custom('notice', 'Peringatan', 'Silahkan pilih museum yang akan dicari' , '#museum');
          return false;
        }

        $.ajax({
          type : 'GET',
          url: '<?= base_url("peta/get_rute") ?>/'+id_su+'/'+id_sm,
          dataType: 'json',
          cache: false,
          success: function(data) {
           console.log(data)
          }
      });

      });

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
            var location = new google.maps.LatLng(data.latitude, data.longitude);
            placeMarker(location, data.nama+' | '+data.alamat);
            shelter_terdekat_museum(data.latitude, data.longitude);
        });
    });

    function shelter_terdekat_user(obj){
      hapus_shelter(null, 0);
      $.ajax({
          type : 'GET',
          url: '<?= base_url("peta/get_nearest_shelter") ?>/'+mylat+'/'+mylong,
          dataType: 'json',
          cache: false,
          success: function(data) {
            $('#id_shelter_user').val(data.id_shelter);
            var location = new google.maps.LatLng(data.latitude, data.longitude);
             shelterMarker(data.id_shelter, location, 'Shelter Terdekat : '+data.shelter);
             map.panTo(location);
             $('#user_dekat').attr('disabled','disabled');
          }
      });

    }

    function shelter_terdekat_museum(lat, longi){
      hapus_shelter(null, 1);
      $.ajax({
          type : 'GET',
          url: '<?= base_url("peta/get_nearest_shelter") ?>/'+lat+'/'+longi,
          dataType: 'json',
          cache: false,
          success: function(data) {
            $('#id_shelter_museum').val(data.id_shelter);
            var location = new google.maps.LatLng(data.latitude, data.longitude);
             shelterMarker(data.id_shelter, location, 'Shelter Terdekat Dengan Museum : '+data.shelter);
             map.panTo(location);
             map.setZoom(13);
          }
      });
    }

    function hapus_shelter(map, n) {
        if(typeof(markers_shelter[n]) !== 'undefined'){
          markers_shelter[n].setMap(map);
        }
    }
  </script>


<title><?= $title ?></title>
<div class="row">
  <div id="map-canvas" class="col-lg-8"></div>
  <input type="hidden" id="id_shelter_museum" />
  <input type="hidden" id="id_shelter_user" />
  
  <div class="col-lg-4" >
    <div class="well" style="min-height:500px;">
      <h4>Pencarian Rute Museum</h4>
      <br/>
      <strong>Cari Shelter Terdekat</strong>
      <br/>
      <br/>
      <button class="btn btn-primary" onclick="shelter_terdekat_user()" id="user_dekat"><i class="fa fa-search"></i> Cari Shelter</button>
      <br/>
      <hr style="border-bottom:1px solid #999;" /> 
      <br/>
      <strong>Pilih Museum</strong>
      
      <?= form_input('museum','','class="form-control" id=museum')?>
      <input type="hidden" id="id_museum"/>
      <br/>
      <button class="btn btn-primary" id="cari_rute"><i class="fa fa-search"></i> Cari Rute</button>
      <hr style="border-bottom:1px solid #999;" /> 
       
      
    </div><!-- /well -->

</div>