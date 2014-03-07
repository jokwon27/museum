<style type="text/css">
  #map-shelter {height: 500px; }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
<script type="text/javascript">
    var markers1 = null, markers2 = null;
    var poly = null;
    var map = {};
    var koord = '';
    var thecenter = new google.maps.LatLng(-7.783069238887897,110.36760125309229);
    function initialize() {
        var mapOptions = {
            zoom: 16,
            center: thecenter
        };

        map = new google.maps.Map(document.getElementById('map-shelter'), mapOptions);
        google.maps.event.addListener(map, 'click', addKoord);

        var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

        var delControlDiv = document.createElement('div');
        var delControl = new deleteControl(delControlDiv, map);

        delControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(delControlDiv);

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function placeMarker(location, index) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            icon : '<?= base_url("assets/img/bus.png") ?>'
        });
        if (index == 1) {
            if (markers1 !== null) {
                markers1.setMap(null);
            };
            markers1 = marker;
        }else{
            if (markers2 !== null) {
                markers2.setMap(null);
            };
            markers2 = marker;
            google.maps.event.addListener(markers2, 'click', addKoord);
        }
    }
    function addKoord(event) {
      var path = poly.getPath();
      koord = JSON.stringify(path.getArray());
      path.push(event.latLng);
      console.log(koord)
    }

    function addKoordMarker(lat, longi) {
      var path = poly.getPath();
      koord = JSON.stringify(path.getArray());
      path.push(new google.maps.LatLng(lat,longi));
    }

    /** @constructor */
    function deleteControl(controlDiv, map) {
      var control = this;

      controlDiv.style.padding = '5px';

      // Set CSS for the control border
      var deleteUI = document.createElement('div');
      deleteUI.style.backgroundColor = 'white';
      deleteUI.style.borderStyle = 'solid';
      deleteUI.style.borderWidth = '2px';
      deleteUI.style.cursor = 'pointer';
      deleteUI.style.textAlign = 'center';
      deleteUI.title = 'Click to set the map to Home';
      controlDiv.appendChild(deleteUI);

      // Set CSS for the control interior
      var deleteText = document.createElement('div');
      deleteText.style.fontFamily = 'Arial,sans-serif';
      deleteText.style.fontSize = '12px';
      deleteText.style.paddingLeft = '4px';
      deleteText.style.paddingRight = '4px';
      deleteText.innerHTML = '<b>Hapus Marker</b>';
      deleteUI.appendChild(deleteText);

      

      // Setup the click event listener for Home:
      // simply set the map to the control's current home property.
      google.maps.event.addDomListener(deleteUI, 'click', function() {
        delete_all_map();
      });

     
    }

    function delete_all_map(){
        if (markers1 !== null) {markers1.setMap(null);};
        if (markers2 !== null) {markers2.setMap(null);};
        if (poly !== null) {poly.setMap(null);};
            var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map)
        koord = '';
        $('#id_shelter_awal, #id_shelter_tujuan, #shelter_awal, #shelter_tujuan').val('');
    }
  
</script>
<script type="text/javascript">
    
	$(function(){
        $("#form_tambah").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
            delete_all_map();
        });
		get_relasi_shelter_list(1);
        $('#bt_reset').click(function(){
            reset_data();
            get_relasi_shelter_list(1);
        });

        $('#bt_add').click(function(){
            tambah_data();
            reset_data();
        });

        $('#formtambah').submit(function(){
            return false;
        });
        
        $('#shelter_awal').autocomplete("<?= base_url('autocomplete/get_shelter') ?>",
        {
            parse: function(data){
                var parsed = [];
                for (var i=0; i < data.length; i++) {
                    parsed[i] = {
                        data: data[i],
                        value: data[i].nama // nama field yang dicari
                    };
                }
                $("input[name=id_shelter_awal]").val('');
                
                return parsed;
            },
            formatItem: function(data,i,max){
                var str = '<div class=result>'+data.nama+'</div>';
                return str;
            },
            width: 400, // panjang tampilan pencarian autocomplete yang akan muncul di bawah textbox pencarian
            dataType: 'json' // tipe data yang diterima oleh library ini disetup sebagai JSON
        }).result(
        function(event,data,formated){
            $(this).val(data.nama);
            $("input[name=id_shelter_awal]").val(data.id);
            addKoordMarker(data.latitude, data.longitude);
            var koord1 = new google.maps.LatLng(data.latitude,data.longitude);
            placeMarker(koord1, 1);
            map.setCenter(koord1);
        });

        $('#shelter_tujuan').autocomplete("<?= base_url('autocomplete/get_shelter') ?>",
        {
            parse: function(data){
                var parsed = [];
                for (var i=0; i < data.length; i++) {
                    parsed[i] = {
                        data: data[i],
                        value: data[i].nama // nama field yang dicari
                    };
                }
                $("input[name=id_shelter_tujuan]").val('');
                
                return parsed;
            },
            formatItem: function(data,i,max){
                var str = '<div class=result>'+data.nama+'</div>';
                return str;
            },
            width: 400, // panjang tampilan pencarian autocomplete yang akan muncul di bawah textbox pencarian
            dataType: 'json' // tipe data yang diterima oleh library ini disetup sebagai JSON
        }).result(
        function(event,data,formated){
            get_relasi_shelter_cek($("input[name=id_shelter_awal]").val(), data.id, data);
        });
        
	});

    function save_data(){
        var stop = false;
        $('input[name=koordinat_rute]').val(koord);
        if ($('id_#shelter_awal').val() == '') {
            dc_validation('#shelter_awal', 'Shelter awal harus diisi!');
            stop = true; 
        }

        if ($('#id_shelter_tujuan').val() == '') {
            dc_validation('#shelter_tujuan', 'Shelter tujuan harus diisi!');
            stop = true; 
        }

        if (stop) {
            return false;
        };

        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/relasi_shelter_save") ?>/', 
            cache: false,
            dataType: 'json',
            data: $('#formtambah').serialize(),
            success: function(data) {
                message_add_succes();
                $('input[name=id]').val(data.id);
                
                get_relasi_shelter_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
                delete_all_map();
                koord = '';
            }, error: function(){
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_failed();
                }else{
                     message_edit_failed();
                }
                 get_relasi_shelter_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }
        });
        

    }

    

    function reset_data(){
        $('input[name=id],#shelter_awal, #shelter_tujuan, #id_shelter_awal, #id_shelter_tujuan, input[name=koordinat_rute], myinput, #search ').val('');
        dc_validation_remove('.myinput');
        map.setCenter(thecenter);
    }

    function tambah_data(){
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#shelter_awal').focus();
    }


    function get_relasi_shelter_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/relasi_shelter_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#relasi_shelter_list').html(data);
            }
        });
    }

    function get_relasi_shelter_cek(awal, tujuan, shelter){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/relasi_shelter_cek") ?>/'+awal+'/'+tujuan,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.cek > 0) {
                    message_custom('notice','Peringatan','Data relasi shelter sudah ada','');
                }else{
                    $('#shelter_tujuan').val(shelter.nama);
                    $("input[name=id_shelter_tujuan]").val(shelter.id);
                    placeMarker(new google.maps.LatLng(shelter.latitude,shelter.longitude), 2);
                }
            }
        });
    }

    function edit_relasi_shelter(id){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/relasi_shelter_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('input[name=id]').val(data.id);
                $('#nama').val(data.nama);
                $('#longitude').val(data.longitude);
                $('#latitude').val(data.latitude);

                var shelterCoord = new google.maps.LatLng(data.latitude,data.longitude);
                placeMarker(shelterCoord);
                map.setCenter(shelterCoord);
                $('#judul_dialog').html('Edit');
                $('#form_tambah').modal('show');
            }
        });
        
    }
    

    function delete_relasi_shelter(id){
            var page = (isNaN($('.noblock').html()))?'1':$('.noblock').html();
            BootstrapDialog.show({
                title: 'Hapus Data',
                closable:true,
                type: BootstrapDialog.TYPE_DEFAULT,
                message: 'Anda yakin akan menghapus data ini?',
                buttons: [
                {
                    label: '<i class="fa fa-refresh"></i> Batal',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                },
                {
                    label: '<i class="fa fa-trash-o"></i> Hapus',
                    cssClass: 'btn-primary',
                    action: function(dialogItself){
                         $.ajax({
                            type : 'GET',
                            url: '<?= base_url("admin/relasi_shelter_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#relasi_shelter_list').html(data);
                                message_delete_succes();
                            },
                            error: function(){
                                message_delete_failed();
                            }
                        });
                         dialogItself.close();
                    }
                }]
            });
         
        }

    function pagination(p){
        get_relasi_shelter_list(p);
    }
</script>

<div>
    <div class="col-lg-8" style="padding-left:0px;">
        <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
        <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Nama Shelter..." onkeyup="get_relasi_shelter_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
	<div id="relasi_shelter_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     
    <div class="modal-dialog" style="width:90%; height:100%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Shelter</h4>
          </div>
        <div class="modal-body body-fit">
            <?= form_open('','id=formtambah class="form-horizontal"') ?>
            <?= form_hidden('id') ?>
            <?= form_hidden('koordinat_rute') ?>
            <input type="hidden" name="id_shelter_awal" id="id_shelter_awal" />
            <input type="hidden" name="id_shelter_tujuan" id="id_shelter_tujuan" />
            <div class="form-group">
                <label class="col-sm-2 control-label">Shelter Awal</label>
                <div class="col-sm-6">
                <?= form_input('shelter_awal','','class="form-control myinput" id=shelter_awal')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Shelter Tujuan</label>
                <div class="col-sm-6">
                <?= form_input('shelter_tujuan','','class="form-control myinput" id=shelter_tujuan')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <div id="map-shelter"></div>
                </div>
            </div>
            
            <?= form_close() ?>       
            
     
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
            <button type="button" class="btn btn-primary" id="bt_save" onclick="save_data()"><i class="fa fa-save"></i> Simpan</button>
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
