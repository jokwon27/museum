<style type="text/css">
  #map-canvas { height: 550px; }
</style>
<link href="<?= base_url('assets/css/jquery.autocomplete.css') ?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/jquery.autocomplete.js') ?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
<script type="text/javascript">
    var mylat = -7.774735;
    var mylong = 110.369164;
    var poly, poly2;
    var rute_array = [];

    var myposition = null;// new google.maps.LatLng(mylat, mylong);
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

      var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

      polyOptions = {
          strokeColor: '#0000FF',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly2 = new google.maps.Polyline(polyOptions);
        poly2.setMap(map);

      
      // Try HTML5 geolocation
      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = new google.maps.LatLng(position.coords.latitude,
                                           position.coords.longitude);
        

          placeMarker(pos, 'Lokasi Anda');
          mylat = position.coords.latitude;
          mylong =position.coords.longitude;
          map.setCenter(pos);
        }, function() {
         // handleNoGeolocation(true);
          var pos = new google.maps.LatLng(mylat, mylong);
          placeMarker(pos, 'Lokasi Anda');
          map.setCenter(pos);
        });
      } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
      }
      /*
      

      placeMarker(myposition, 'Lokasi Anda');

      map.setCenter(myposition);
      */
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

    function addLatLngEdit(lat, longi, line) {
      if (line == 0) {
        var path = poly.getPath();
      }else{
        var path = poly2.getPath();
      }
      
      path.push(new google.maps.LatLng(lat,longi));
    }

    function draw_path_shelter(index, nama, latitude,longitude){
      var location = new google.maps.LatLng(latitude,
                                           longitude);
      hapus_shelter(null, 4);
      if (nama !== 'undefined') {
        shelterMarker(0, location, 'Shelter Oper : '+nama);
      };
      

      delete_all_map();
      $.each(rute_array[index], function(i, v){
        if (v.rute.length > 0) {
        //if (i == 0) {
          $.each(v.rute, function(j, w){
            addLatLngEdit(parseFloat(w.d), parseFloat(w.e), i);
          });
        };
        
    });
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

    function delete_all_map(){
      poly.setMap(null);
      poly2.setMap(null);

        var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

      polyOptions = {
          strokeColor: '#0000FF',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly2 = new google.maps.Polyline(polyOptions);
        poly2.setMap(map);
    }

    $(function(){
      shelter_terdekat_user();
      $('#cari_rute').click(function(){
        var id_sm = $('#museum_choice').val();
        var id_su = $('#shelter_choice').val();
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
        $('#accordion').empty();
        $.ajax({
            type : 'GET',
            url: '<?= base_url("peta/get_rute") ?>/'+id_su+'/'+id_sm,
            dataType: 'json',
            cache: false,
            success: function(data) {
              $('#museum').attr('disabled', 'disabled');
              
              $.each(data, function(i, v){
                  rute_array[i] = v.rute_detail;
                  var oper = '<br/>Saat sampai di <b>'+v.titik_oper.nama+'</b> anda pindah ke <b>'+v.jalur_akhir+'</b></dd>'
                  var str = '<div class="bs-callout bs-callout-info">'+
                              '<h4><strong>'+v.judul+'</strong></h4>'+
                              '<dl class="dl-horizontal">'+
                                '<dt>Rute</dt>'+
                                '<dd>Anda naik <b>'+v.jalur_awal+'</b>'+
                                ((v.intersect !== null)?oper:'')+
                                '<dt>Jarak Tempuh</dt>'+
                                '<dd><b>'+v.jarak_tempuh+' Km</b></dd>'+
                                '<dt></dt>'+
                                '<dd><button class="btn btn-primary btn-xs" onclick="draw_path_shelter('+i+',\''+v.titik_oper.nama+'\',\''+v.titik_oper.latitude+'\',\''+v.titik_oper.longitude+'\')"><i class="fa fa-eye"></i> Tampilkan Rute</button></dd>'+
                              '</dl>'+
                            '</div>';
                  $('#accordion').append(str);
              });
                
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
      $.ajax({
          type : 'GET',
          url: '<?= base_url("peta/get_nearest_shelter") ?>/'+mylat+'/'+mylong,
          dataType: 'json',
          cache: false,
          success: function(data) {
            $('#shelter_choice').empty();
            
            var str = '';
            str = '<option value="">Pilih shelter terdekat</option>'
            $('#shelter_choice').append(str);
            $.each(data, function(i, v){
                var location = new google.maps.LatLng(v.latitude, v.longitude);
               shelterMarker(v.id, location, 'Shelter terdekat dengan user : '+ v.nama);
               map.panTo(location);

               str = '<option value="'+v.id+'">'+ v.nama +'</option>'
               $('#shelter_choice').append(str);
            });
            
          }
      });

    }

    function shelter_terdekat_museum(lat, longi){
      $.ajax({
          type : 'GET',
          url: '<?= base_url("peta/get_nearest_shelter") ?>/'+lat+'/'+longi,
          dataType: 'json',
          cache: false,
          success: function(data) {
            $('#museum_choice').empty();
            
            var str = '';
            str = '<option value="">Pilih shelter terdekat</option>'
            $('#museum_choice').append(str);
            $.each(data, function(i, v){
                var location = new google.maps.LatLng(v.latitude, v.longitude);
               shelterMarker(v.id, location, 'Shelter terdekat dengan museum : '+ v.nama);
               map.panTo(location);

               str = '<option value="'+v.id+'">'+ v.nama +'</option>'
               $('#museum_choice').append(str);
            });
            map.setZoom(13);
             
          }
      });
    }

    function hapus_shelter(map, n) {
        if(typeof(markers_shelter[n]) !== 'undefined'){
          markers_shelter[n].setMap(map);
        }
    }

    function hapus_marker(map, n) {
        if(typeof(markers[n]) !== 'undefined'){
          markers[n].setMap(map);
        }
    }

    function reset_data(){
      shelter_terdekat_user();
      hapus_marker(null,0);
      hapus_marker(null, 1);
      hapus_shelter(null, 0);
      hapus_shelter(null, 1);
      $('input[name=id_museum]').val('');
      initialize();
      $('#museum').removeAttr('disabled');
      $('#museum').val('');
      $('#accordion, #shelter_choice, #museum_choice').empty();
    }
  </script>


<title><?= $title ?></title>
<div class="row">
  <div id="map-canvas" class="col-lg-8"></div>
  
  <div class="col-lg-4" >
    <div class="well" style="min-height:550px;">
      <h4>Pencarian Rute Museum</h4>
      <br/>
      <strong>Pilih Museum</strong>      
      <?= form_input('museum','','class="form-control" id=museum')?>
      <input type="hidden" id="id_museum"/>
      <hr style="border-bottom:1px solid #999;" /> 
      <strong>Shelter Terdekat dengan user</strong>
      <?= form_dropdown('shelter', array(), array(), 'id=shelter_choice class=form-control') ?>
      <br/>
      <strong>Shelter Terdekat dengan museum</strong>
      <?= form_dropdown('museum', array(), array(), 'id=museum_choice class=form-control') ?>
      <br/>
      <button class="btn btn-primary" id="cari_rute"><i class="fa fa-search"></i> Cari Rute</button>
      <button class="btn btn-default" onclick="reset_data()"><i class="fa fa-refresh"></i> Ulang Pencarian</button>
      
    </div><!-- /well -->

  </div>
</div>
<div class="row" style="min-height:300px;">
  <div class="col-lg-8">
    <h3>Alternatif Jalur Trans Jogja</h3>
    <hr/>
    <div id="accordion"></div>

  </div>

</div>