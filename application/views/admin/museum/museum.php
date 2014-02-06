<script type="text/javascript" src="<?= base_url('public/editor/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/editor/ckeditor/config.js') ?>"></script>
<script type="text/javascript">
    
	$(function(){
		get_museum_list(1);
        $('#bt_reset').click(function(){
           get_museum_list(1);
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
        var stop = false;
        if ($('#nama').val() == '') {
            dc_validation('#nama', 'Nama harus diisi!');
            stop = true; 
        }

        if ($('#alamat').val() == '') {
           dc_validation('#alamat', 'Alamat harus diisi!');
            stop = true; 
        }

        if ($('#url').val() == '') {
             dc_validation('#url', 'URL harus diisi!');
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

        if (CKEDITOR.instances.keterangan.getData() == '') {
             CKEDITOR.instances.keterangan.setData($('#nama').val());
        }

        if (stop) {
            return false;
        };


        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/master_museum_save") ?>/', 
            cache: false,
            dataType: 'json',
            data: $('#formtambah').serialize()+'&keterangan_museum='+CKEDITOR.instances.keterangan.getData(),
            success: function(data) {
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_succes();
                }else{
                     message_edit_succes();
                }
               
                get_museum_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }, error: function(){
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_failed();
                }else{
                     message_edit_failed();
                }
                 get_museum_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }
        });
        

    }

    

    function reset_data(){
        $('input[name=id], #nama, #alamat, #longitude, #latitude, #url ').val('');
        CKEDITOR.instances.keterangan.setData('');
        dc_validation_remove('.form-control');
    }

    function tambah_data(){
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#nama').focus();
    }


    function get_museum_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/master_museum_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#museum_list').html(data);
            }
        });
    }

    function edit_museum(id){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/master_museum_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('input[name=id]').val(data.id);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#longitude').val(data.longitude);
                $('#latitude').val(data.latitude);
                $('#url').val(data.url);
                CKEDITOR.instances.keterangan.setData(data.keterangan);
                $('#judul_dialog').html('Edit');
                $('#form_tambah').modal('show');
            }
        });
        
    }

    function preview_museum(id){
         $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/museum_preview") ?>/'+id,
            cache: false,
            success: function(data) {
                $('#preview_body').html(data);
                $('#modal_preview').modal();
            }
        });
        
    }

    

    function delete_museum(id){
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
                            url: '<?= base_url("admin/master_museum_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#museum_list').html(data);
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
        get_museum_list(p);
    }

    function set_url(obj){
        dc_validation_remove('#url');
        var title = $(obj).val();
        var url = title.toLowerCase().replace(/ /g,'-');
        $('#url').val(url);
    }
</script>

<div>
    <div class="col-lg-8" style="padding-left:0px;">
        <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
        <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Nama Museum..." onkeyup="get_museum_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
	<div id="museum_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     <?= form_open('','id=formtambah class="form-horizontal"') ?>
    <div class="modal-dialog higherWider">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Museum</h4>
          </div>
        <div class="modal-body body_fit">
       <?= form_hidden('id') ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Museum</label>
            <div class="col-sm-6">
            <?= form_input('nama','','class=form-control id=nama onkeyup=set_url(this)')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-6">
            <?= form_textarea('alamat','','class=form-control id=alamat')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">URL</label>
            <div class="col-sm-6">
            <?= form_input('url','','class=form-control id=url')?>
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
        <div class="form-group">
            <label class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
            <?= form_textarea('keterangan','','id=keterangan')?>
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

<div id="modal_preview" class="modal fade">
    <div class="modal-dialog higherWider">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Preview</h4>
          </div>
        <div class="modal-body body_fit">
             <div id="preview_body"></div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
           
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
CKEDITOR.replace( 'keterangan', {
        uiColor: '#14B8C4'
    });
</script>