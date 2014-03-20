<script type="text/javascript" src="<?= base_url('public/editor/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/editor/ckeditor/config.js') ?>"></script>
<script type="text/javascript">
    
	$(function(){
		get_artikel_list(1);
        $('#bt_reset').click(function(){
            reset_data();
            get_artikel_list(1);
        });

        $('#bt_add').click(function(){
            tambah_data();
        });

        $('#formtambah').submit(function(e){
            e.preventDefault();
            $.ajaxFileUpload({
                url             :'<?= base_url() ?>/admin/upload_tumbnail/tumbnail_artikel', 
                secureuri       :false,
                fileElementId   :'tumbnail',
                dataType        : 'json',
                data            : {
                    'title'             : $('#nama_image').val()
                },
                success : function (data, status)
                {
                    if(data.status != 'error')
                    {
                        alert('berhasil upload file');
                        $('#nama_image').val(data.filename)
                    }
                    
                }
            });
            return false;
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
            
        });

        
	});

    function save_data(){
        var stop = false;
        if ($('#judul').val() == '') {
             dc_validation('#judul', 'Judul harus diisi!');
             stop = true; 
        }

        if ($('input[name=id_museum]').val() == '') {
             dc_validation('#museum', 'Museum harus diisi!');
             stop = true; 
        }

        if ($('#url').val() == '') {
             dc_validation('#url', 'URL harus diisi!');
             stop = true; 
        }

        if (CKEDITOR.instances.isi.getData() == '') {
            CKEDITOR.instances.isi.setData($('#judul').val());
        }

        if (stop) {
            return false;
        };


        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/artikel_save") ?>/', 
            cache: false,
            dataType: 'json',
            data: $('#formtambah').serialize()+'&isi_artikel='+CKEDITOR.instances.isi.getData(),
            success: function(data) {
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_succes();
                }else{
                     message_edit_succes();
                }
               
                get_artikel_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }, error: function(){
                if( $('input[name=id]').val() == ''){
                    $('input[name=id]').val(data.id);
                    message_add_failed();
                }else{
                     message_edit_failed();
                }
                 get_artikel_list(1);
                $('#form_tambah').modal('hide');
                reset_data();
            }
        });
        

    }

    

    function reset_data(){
        $('input[name=id], #museum, #judul, input[name=id_museum], #url, #search').val('');
        CKEDITOR.instances.isi.setData('');
        dc_validation_remove('.myinput');
    }

    function tambah_data(){
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#judul').focus();
    }


    function get_artikel_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/artikel_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#artikel_list').html(data);
            }
        });
    }

    function edit_artikel(id){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/artikel_data") ?>/'+id,
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('input[name=id]').val(data.id);
                $('#museum').val(data.museum);
                $('input[name=id_museum]').val(data.id_museum);
                $('#judul').val(data.judul);
                $('#url').val(data.url);
                CKEDITOR.instances.isi.setData(data.isi);
                $('#judul_dialog').html('Edit');
                $('#form_tambah').modal('show');
            }
        });
        
    }

    function preview_artikel(id){
         $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/artikel_preview") ?>/'+id,
            cache: false,
            success: function(data) {
                $('#preview_body').html(data);
                $('#modal_preview').modal();
            }
        });
        
    }

    

    function delete_artikel(id){
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
                            url: '<?= base_url("admin/artikel_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#artikel_list').html(data);
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
        get_artikel_list(p);
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
            <input type="text" class="form-control" id="search" placeholder="Judul..." onkeyup="get_artikel_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
	<div id="artikel_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     <?= form_open('','id=formtambah class="form-horizontal"') ?>
     <?= form_hidden('id_museum') ?>
    <div class="modal-dialog higherWider">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data Artikel</h4>
          </div>
        <div class="modal-body body_fit">
       <?= form_hidden('id') ?>
       <input type="hidden" name="nama_image" id="nama_image"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">Judul</label>
            <div class="col-sm-6">
            <?= form_input('judul','','class="form-control myinput" id=judul onkeyup=set_url(this)')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Museum</label>
            <div class="col-sm-6">
            <?= form_input('museum','','class="form-control myinput" id=museum')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">URL</label>
            <div class="col-sm-6">
            <?= form_input('url','','class="form-control myinput" id=url')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Isi Artikel</label>
            <div class="col-sm-10">
            <?= form_textarea('isi','','id=isi')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tumbnail</label>
            <div class="col-sm-6">
                <input type="file" name="tumbnail" id="tumbnail" size="20" />
                <input type="submit" name="submit" id="submit" value="Upload" />
            </div>
        </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
            <button type="button" class="btn btn-primary" id="bt_save" onclick="save_data()"><i class="fa fa-save"></i> Simpan</button>
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
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
           
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
CKEDITOR.replace( 'isi', {
        uiColor: '#14B8C4'
    });
</script>