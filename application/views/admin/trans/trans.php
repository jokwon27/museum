<style type="text/css">
  #map-trans, #map-preview {height: 500px; }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABJD9IIW_lEgd8azMKO4YS-GfF7T7weuk&sensor=false"></script>
<script type="text/javascript">
    var poly;
    var poly_preview;
    var map = {};
    var koord = '';
    var map_preview = {};
    var markers = [];
    var pointer_shelter = [];
    var thecenter = new google.maps.LatLng(-7.783069238887897,110.36760125309229);

    function initialize() {
        var mapOptions = {
        zoom: 14,
        center: thecenter
        };

        map = new google.maps.Map(document.getElementById('map-trans'), mapOptions);

        var polyOptions = {
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

        
        google.maps.event.addListener(map, 'click', addLatLng);

        var delControlDiv = document.createElement('div');
        var delControl = new deleteControl(delControlDiv, map);

        delControlDiv.index = 1;

        var undoControlDiv = document.createElement('div');
        var undoControl = new undoActControl(undoControlDiv, map);

        undoControlDiv.index = 2;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(delControlDiv);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(undoControlDiv);
    }

    function placeMarker(location,id, judul) {
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: judul,
            id_shelter: id,
            icon : '<?= base_url("assets/img/bus.png") ?>'
        });
        google.maps.event.addListener(marker, 'click', function(){
          var lgt = pointer_shelter.length;
          if (lgt == 0) {
            pointer_shelter.push(this.id_shelter);
          };
          if((lgt > 0) && (pointer_shelter[lgt - 1] !== this.id_shelter)){
            pointer_shelter.push(this.id_shelter);
            var lg = pointer_shelter.length;
            if (lg > 1) {
              draw_path_shelter(pointer_shelter[lg-2],this.id_shelter);
            };
            console.log(pointer_shelter)
          }
          
        });


        markers.push(marker);
    }

    function draw_path_shelter(id_shelter1,id_shelter2){
      $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/get_koordinat_shelter") ?>/'+id_shelter1+'/'+id_shelter2,
            dataType: 'json',
            cache: false,
            success: function(data) {
                if (data !== null) {
                  $.each(JSON.parse(data.jalur), function(i, v){
                      addLatLngEdit(v.d, v.e)
                      console.log(v.d)
                  });
                }else{
                  pointer_shelter.remove(pointer_shelter.length-1)
                }
                
            }
        });
    }

  

    function get_all_shelter(){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/get_all_shelter") ?>/',
            dataType: 'json',
            cache: false,
            success: function(data) {
                $.each(data, function(i,v){
                    placeMarker(new google.maps.LatLng(v.latitude,v.longitude),v.id, 'Shelter '+v.nama);
                });
            }
        });
    }


    function addLatLng(event) {

      var path = poly.getPath();
      koord = JSON.stringify(path.getArray());
      path.push(event.latLng);      
    }

    function addLatLngEdit(lat, longi) {
      var path = poly.getPath();
      path.push(new google.maps.LatLng(lat,longi));
    }

    function addLatLngPreview(lat, longi) {

      var path_preview = poly_preview.getPath();
      path_preview.push(new google.maps.LatLng(lat,longi));
    }
    
    function initialize_preview() {
        var mapOptions = {
        zoom: 14,
        center: thecenter
        };

        map_preview = new google.maps.Map(document.getElementById('map-preview'), mapOptions);

        var polyOptions = {
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 3
        };
        poly_preview = new google.maps.Polyline(polyOptions);
        poly_preview.setMap(map_preview);

    }

    function removeLine() {
      poly.setMap(null);
    }

    function removeLinePreview() {
      poly_preview.setMap(null);
    }

    function undoPath(){
      var path = poly.getPath();
      var n = path.b.length;
      path.b.splice(n-1, 1 );
      koord = JSON.stringify(path.getArray());
      poly.setPath(path)
    }


    /** @constructor */
    function deleteControl(controlDiv, map) {

      // We set up a variable for this since we're adding
      // event listeners later.
      var control = this;

      // Set CSS styles for the DIV containing the control
      // Setting padding to 5 px will offset the control
      // from the edge of the map
      controlDiv.style.padding = '5px';

      // Set CSS for the control border
      var deleteUI = document.createElement('div');
      deleteUI.style.backgroundColor = 'white';
      deleteUI.style.borderStyle = 'solid';
      deleteUI.style.borderWidth = '2px';
      deleteUI.style.cursor = 'pointer';
      deleteUI.style.textAlign = 'center';
      deleteUI.title = 'Klik Untuk Hapus Rute';
      controlDiv.appendChild(deleteUI);

      // Set CSS for the control interior
      var deleteText = document.createElement('div');
      deleteText.style.fontFamily = 'Arial,sans-serif';
      deleteText.style.fontSize = '12px';
      deleteText.style.paddingLeft = '4px';
      deleteText.style.paddingRight = '4px';
      deleteText.innerHTML = '<b>Hapus Rute</b>';
      deleteUI.appendChild(deleteText);

      

      // Setup the click event listener for Home:
      // simply set the map to the control's current home property.
      google.maps.event.addDomListener(deleteUI, 'click', function() {
        $('input[name=koordinat_rute]').val('');
        koord = '';
        removeLine();
        initialize();
      });

    }

    function undoActControl(controlDiv, map) {

      // We set up a variable for this since we're adding
      // event listeners later.
      var control = this;

      // Set CSS styles for the DIV containing the control
      // Setting padding to 5 px will offset the control
      // from the edge of the map
      controlDiv.style.padding = '5px';

      // Set CSS for the control border
      var undoUI = document.createElement('div');
      undoUI.style.backgroundColor = 'white';
      undoUI.style.borderStyle = 'solid';
      undoUI.style.borderWidth = '2px';
      undoUI.style.cursor = 'pointer';
      undoUI.style.textAlign = 'center';
      undoUI.title = 'Undo';
      controlDiv.appendChild(undoUI);

      // Set CSS for the control interior
      var undoText = document.createElement('div');
      undoText.style.fontFamily = 'Arial,sans-serif';
      undoText.style.fontSize = '12px';
      undoText.style.paddingLeft = '4px';
      undoText.style.paddingRight = '4px';
      undoText.innerHTML = '<b>Undo</b>';
      undoUI.appendChild(undoText);

      

      // Setup the click event listener for Home:
      // simply set the map to the control's current home property.
      google.maps.event.addDomListener(undoUI, 'click', function() {
          undoPath();
       
      });


    }
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, 'load', initialize_preview);
  
</script>
<script type="text/javascript">
    
    $(function(){
        
        $("#form_tambah").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
            get_all_shelter();
        });

        $("#modal_preview").on("shown.bs.modal", function () {
            google.maps.event.trigger(map_preview, "resize");
        });
        get_trans_list(1);
        $('#bt_reset').click(function(){
            reset_data();
            get_trans_list(1);
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
        $('input[name=koordinat_rute]').val(koord);
        if ($('#nama').val() == '') {
            dc_validation('#nama', 'Nama Rute harus diisi!');
            stop = true; 
        }

        
        if (stop) {
            return false;
        };

        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/trans_save") ?>/', 
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
               
                get_trans_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }, error: function(){
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_failed();
                }else{
                     message_edit_failed();
                }
                 get_trans_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }
        });
        

    }

    

    function reset_data(){
        $('input[name=id], #nama, #rute, input[nama=koordinat_rute], #search').val('');
        dc_validation_remove('.myinput');
        removeLine();
        initialize();
        map.setCenter(thecenter);
    }

    function tambah_data(){
        initialize();
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#nama').focus();
    }


    function get_trans_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/trans_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#trans_list').html(data);
            }
        });
    }

    function edit_trans(id){
        removeLine();
        initialize();
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/trans_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('input[name=id]').val(data.id);
                $('#nama').val(data.nama);
                $('#rute').val(data.rute);
                $('input[name=koordinat_rute]').val(data.koordinat_rute);
                if (data.koordinat_rute !== null) {
                    $.each(JSON.parse(data.koordinat_rute), function(i, v){
                        addLatLngEdit(v.d , v.e);
                    });
                };
                
                $('#judul_dialog').html('Edit');
                $('#form_tambah').modal('show');
            }
        });
        
    }

    function detail_rute(id){
        removeLinePreview();
        initialize_preview();
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/trans_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('#judul_rute').html(data.nama);
                $('#rute_jalan').html(data.rute);
                if (data.koordinat_rute !== null) {
                    $.each(JSON.parse(data.koordinat_rute), function(i, v){
                        addLatLngPreview(v.d , v.e)
                    });
                };
                
                
                map.setCenter(thecenter);
                $('#modal_preview').modal('show');
            }
        });
        
    }
    

    function delete_trans(id){
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
                            url: '<?= base_url("admin/trans_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#trans_list').html(data);
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
        get_trans_list(p);
    }
</script>

<div>
    <div class="col-lg-8" style="padding-left:0px;">
        <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
        <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Nama Rute..." onkeyup="get_trans_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
  <div id="trans_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
    <div class="modal-dialog" style="width:90%; height:100%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Rute</h4>
          </div>
        <div class="modal-body body-fit">
            <?= form_open('','id=formtambah class="form-horizontal"') ?>
           <?= form_hidden('id') ?>
           <?= form_hidden('koordinat_rute') ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Rute</label>
                <div class="col-sm-6">
                <?= form_input('nama','','class="form-control myinput" id=nama')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Rute</label>
                <div class="col-sm-6">
                <?= form_textarea('rute','','class="form-control myinput" id=rute')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Koordinat Rute</label>
                <div class="col-sm-10">
                    <div id="map-trans"></div>
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

<div id="modal_preview" class="modal fade">
    <div class="modal-dialog" style="width:90%; height:100%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Preview</h4>
          </div>
        <div class="modal-body body_fit">
            <h2>Rute <span id="judul_rute"></span></h2>
            <hr/>
            <div id="rute_jalan"></div>
            <hr/>
            <div id="map-preview"></div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
           
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
