<style type="text/css">
  #map-shelter {height: 300px; }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
<script type="text/javascript">
    var markers = [];
    var map = {};
    var thecenter = new google.maps.LatLng(-7.783069238887897,110.36760125309229);
    function initialize() {
        var mapOptions = {
            zoom: 16,
            center: thecenter
        };

        map = new google.maps.Map(document.getElementById('map-shelter'), mapOptions);
        google.maps.event.addListener(map, 'click', function(event) {
            setAllMap(null);
            placeMarker(event.latLng);
           $('#latitude').val(event.latLng.k);
           $('#longitude').val(event.latLng.A);
        });

        var delControlDiv = document.createElement('div');
        var delControl = new deleteControl(delControlDiv, map);

        delControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(delControlDiv);

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function placeMarker(location) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            icon : '<?= base_url("assets/img/bus.png") ?>'
        });
        markers.push(marker);
    }

    function setAllMap(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
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
        $('#latitude, #longitude').val('');
        setAllMap(null);
      });

     
    }

  
</script>
<script type="text/javascript">
    
	$(function(){
        $("#form_tambah").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
        });
		get_shelter_list(1);
        $('#bt_reset').click(function(){
            reset_data();
            get_shelter_list(1);
        });

        $('#bt_add').click(function(){
            tambah_data();
            reset_data();
        });

        $('#formtambah').submit(function(){
            return false;
        });
        
        
	});

    function save_data(){
        var stop = false;

        if ($('#nama').val() == '') {
            dc_validation('#nama', 'Nama harus diisi!');
            stop = true; 
        }

        if ($('#longitude').val() == '') {
            dc_validation('#longitude', 'Longitude harus diisi!');
            stop = true; 
        }

        if ($('#latitude').val() == '') {
            dc_validation('#latitude', 'Latitude harus diisi!');
            stop = true; 
        }

        if (stop) {
            return false;
        };

        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/shelter_save") ?>/', 
            cache: false,
            dataType: 'json',
            data: $('#formtambah').serialize(),
            success: function(data) {
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_succes();
                }else{
                     message_edit_succes();
                }
               
                get_shelter_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }, error: function(){
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_failed();
                }else{
                     message_edit_failed();
                }
                 get_shelter_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }
        });
        

    }

    

    function reset_data(){
        $('input[name=id], #nama, #longitude, #latitude, myinput, #search ').val('');
        dc_validation_remove('.myinput');
        setAllMap(null);
        map.setCenter(thecenter);
    }

    function tambah_data(){
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#nama').focus();
    }


    function get_shelter_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/shelter_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#shelter_list').html(data);
            }
        });
    }

    function edit_shelter(id){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/shelter_data") ?>/'+id,
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
    

    function delete_shelter(id){
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
                            url: '<?= base_url("admin/shelter_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#shelter_list').html(data);
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
        get_shelter_list(p);
    }
</script>

<div>
    <div class="col-lg-8" style="padding-left:0px;">
        <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
        <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Nama Shelter..." onkeyup="get_shelter_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
	<div id="shelter_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     
    <div class="modal-dialog higherWider">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Shelter</h4>
          </div>
        <div class="modal-body body-fit">
            <?= form_open('','id=formtambah class="form-horizontal"') ?>
           <?= form_hidden('id') ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Shelter</label>
                <div class="col-sm-6">
                <?= form_input('nama','','class="form-control myinput" id=nama')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Longitude</label>
                <div class="col-sm-6">
                <?= form_input('longitude','','class="form-control myinput" id=longitude')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Latitude</label>
                <div class="col-sm-6">
                <?= form_input('latitude','','class="form-control myinput" id=latitude')?>
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
