<script type="text/javascript">
	$(function(){
		get_user_list(1);
        $('#bt_reset').click(function(){
           get_user_list(1);
           $('input[name=id]').val('');
        });

        $('#bt_add').click(function(){
            tambah_data();
        });

        $('#formtambah').submit(function(){
            return false;
        });
	});

    function save_data(){
        if ($('#user').val() == '') {
            message_custom('notice', 'Peringatan', 'Username harus diisi!', '#user');
        }else{
            $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/master_user_save") ?>/', 
            cache: false,
            dataType: 'json',
            data: $('#formtambah').serialize(),
            success: function(data) {
                $('input[name=id]').val(data.id);
                get_user_list(1);
                //$('#form_tambah').modal('dismiss');
            }
        });
        }

    }

    function tambah_data(){
         $('#form_tambah').modal();
         $('#user').focus();
    }


    function get_user_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/master_user_list") ?>/'+p,
            data: $('#formtambah').serialize(),
            cache: false,
            success: function(data) {
                $('#user_list').html(data);
            }
        });
    }

    function delete_user(id){
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
                            url: '<?= base_url("admin/master_user_delete") ?>/'+id+'/'+page,
                            cache: false,
                            success: function(data) {
                                $('#user_list').html(data);
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
        get_user_list(p);
    }
</script>

<div>
    <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
    <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    
    <br/>
	<div id="user_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     <?= form_open('','id=formtambah class="form-horizontal"') ?>
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tambah Data User</h4>
          </div>
        <div class="modal-body">
       <?= form_hidden('id') ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-6">
            <?= form_input('user','','class=form-control id=user')?>
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