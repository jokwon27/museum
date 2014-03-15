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

    function draw_path_shelter(jalur_awal, jalur_akhir, intersect){
      delete_all_map();
      var shelter_user = $('#shelter_choice').val();
      var shelter_museum = $('#museum_choice').val();
      $.ajax({
            type : 'GET',
            url: '<?= base_url("peta/get_rute_trans_jogja") ?>/',
            data: 'shelter_awal='+shelter_user+'&shelter_akhir='+shelter_museum+'&jalur_awal='+jalur_awal+'&jalur_akhir='+jalur_akhir+'&intersect='+intersect,
            dataType: 'json',
            cache: false,
            success: function(data) {
                
                if (data.length > 0) {
                  $.each(data, function(i, v){
                      if (v.rute.length > 0) {
                        $.each(v.rute, function(j, w){
                          addLatLngEdit(parseFloat(w.d), parseFloat(w.e), i);
                        });
                      };
                      
                  });

                }else{
                  alert('Tidak Ada Rute');
                }        
                /*
                if(data.shelter.length > 0){
                  $.each(data.shelter, function(i, v){
                    var location = new google.maps.LatLng(v.latitude, v.longitude);
                    shelterMarker(v.id, location, v.nama);

                  });
                }         
                */
            }
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

    function  shelterMarker(id, location, judul ) {
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
              $('#list_jalur').empty();
              $.each(data, function(i, v){
                  var str = '<div class="panel panel-default">'+
                              '<div class="panel-heading">'+
                                '<h4 class="panel-title">'+
                                  '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'+i+'">'+
                                     v.judul+
                                  '</a>'+
                                '</h4>'+
                              '</div>'+
                              '<div id="collapse'+i+'" class="panel-collapse collapse">'+
                                '<div class="panel-body">'+
                                  '<button onclick="draw_path_shelter('+((v.id_jalur_awal !== '')?v.id_jalur_awal:'0')+', '+((v.id_jalur_akhir !== '')?v.id_jalur_akhir:'0')+', '+((v.intersect !== null)?v.intersect:'0')+')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Tampilkan Rute</button><br/>'+
                                  '<dl>'+
                                    '<dt>Rute</dt>'+
                                    '<dd>'+v.rangkaian_jalur+'</dd>'+
                                  '</dl>'+
                                  '<dl>'+
                                    '<dt>Pindah Shelter</dt>'+
                                    '<dd>'+v.titik_oper+'</dd>'+
                                  '</dl>'+
                                  '<dl>'+
                                    '<dt>...</dt>'+
                                    '<dd>...</dd>'+
                                  '</dl>'+'<dl>'+
                                    '<dt>...</dt>'+
                                    '<dd>...</dd>'+
                                  '</dl>'+
                                '</div>'+
                              '</div>'+
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
            
             $('#user_dekat').attr('disabled','disabled');
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
      hapus_marker(null,0);
      hapus_marker(null, 1);
      hapus_shelter(null, 0);
      hapus_shelter(null, 1);
      $('input[name=id_museum]').val('');
      initialize();
      $('#user_dekat, #museum').removeAttr('disabled');
      $('#museum').val('');
      $('#accordion, #shelter_choice, #museum_choice').empty();
    }
  </script>


<title><?= $title ?></title>
<div class="row">
  <div id="map-canvas" class="col-lg-8"></div>
  
  <div class="col-lg-4" >
    <div class="well" style="height:550px;">
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
      <hr style="border-bottom:1px solid #999;" /> 
      <strong>Shelter Terdekat dengan user</strong>
      <?= form_dropdown('shelter', array(), array(), 'id=shelter_choice class=form-control') ?>
      <br/>
      <strong>Shelter Terdekat dengan museum</strong>
      <?= form_dropdown('museum', array(), array(), 'id=museum_choice class=form-control') ?>
      <br/>
      <button class="btn btn-primary" id="cari_rute"><i class="fa fa-search"></i> Cari Rute</button>
      <button class="btn btn-default" onclick="reset_data()" id="user_dekat"><i class="fa fa-refresh"></i> Ulang Pencarian</button>
      
    </div><!-- /well -->

  </div>
</div>
<div class="row" style="min-height:300px;">
  <div class="col-lg-8">
    <h3>Alternatif Jalur Trans Jogja</h3>
    <hr/>

    <div class="panel-group" id="accordion">
      

    </div>

  </div>

</div>