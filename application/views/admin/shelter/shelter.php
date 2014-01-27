<script type="text/javascript">
    
	$(function(){
		get_shelter_list(1);
        $('#bt_reset').click(function(){
           get_shelter_list(1);
           reset_data();
        });

        $('#bt_add').click(function(){
            tambah_data();
        });

        $('#formtambah').submit(function(){
            return false;
        });
        
        
	});

    function save_data(){
        if ($('#nama').val() == '') {
            message_custom('notice', 'Peringatan', 'Nama harus diisi!', '#nama');
            return false;
        }

        if ($('#longitude').val() == '') {
            message_custom('notice', 'Peringatan', 'Longitude harus diisi!', '#longitude');
            return false;
        }

        if ($('#latitude').val() == '') {
            message_custom('notice', 'Peringatan', 'Latitude harus diisi!', '#latitude');
            return false;
        }


        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/master_shelter_save") ?>/', 
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
        $('input[name=id], #nama, #longitude, #latitude ').val('');
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
            url: '<?= base_url("admin/master_shelter_list") ?>/'+p,
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
            url: '<?= base_url("admin/master_shelter_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('input[name=id]').val(data.id);
                $('#nama').val(data.nama);
                $('#longitude').val(data.longitude);
                $('#latitude').val(data.latitude);
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
                    label: 'Batal',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                },
                {
                    label: 'Hapus',
                    cssClass: 'btn-primary',
                    action: function(dialogItself){
                         $.ajax({
                            type : 'GET',
                            url: '<?= base_url("admin/master_shelter_delete") ?>/'+id+'/'+page,
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
     <?= form_open('','id=formtambah class="form-horizontal"') ?>
    <div class="modal-dialog higherWider">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Shelter</h4>
          </div>
        <div class="modal-body body_fit">
       <?= form_hidden('id') ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Shelter</label>
            <div class="col-sm-6">
            <?= form_input('nama','','class=form-control id=nama')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Longitude</label>
            <div class="col-sm-6">
            <?= form_input('longitude','','class=form-control id=longitude')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Latitude</label>
            <div class="col-sm-6">
            <?= form_input('latitude','','class=form-control id=latitude')?>
            </div>
        </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="bt_save" onclick="save_data()">Simpan</button>
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <?= form_close() ?>
</div><!-- /.modal -->
