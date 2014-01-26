<script type="text/javascript">
	$(function(){
		get_user_list(1);
        $('#bt_reset').click(function(){
           get_user_list(1);
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
                    if( $('input[name=id]').val() == ''){
                        $('input[name=id]').val(data.id);
                        message_add_succes();
                    }else{
                         message_edit_succes();
                    }
                   
                    get_user_list(1);
                    $('#form_tambah').modal('hide');
                    reset_data();
                }, error: function(){
                    if( $('input[name=id]').val() == ''){
                        $('input[name=id]').val(data.id);
                        message_add_failed();
                    }else{
                         message_edit_failed();
                    }
                     get_user_list(1);
                    $('#form_tambah').modal('hide');
                    reset_data();
                }
            });
        }

    }

    function save_priv_data(){
        var id_user =  $('input[name=id_user]').val();
        $.ajax({
                type : 'POST',
                url: '<?= base_url("admin/save_privileges") ?>/'+id_user, 
                cache: false,
                dataType: 'json',
                data: $('#formpriv').serialize(),
                success: function(data) {
                    if( data.status == true){
                        message_edit_succes();
                    }else{
                        message_edit_failed(); 
                    }
                }, error: function(){
                    message_edit_failed();
                   
                }
            });
    }

    function reset_data(){
        $('input[name=id], #user').val('');
    }

    function tambah_data(){
        $('#judul_dialog').html('Tambah');
        $('#form_tambah').modal().on('hidden.bs.modal', function (e) {
          reset_data();
        })
         $('#user').focus();
    }


    function get_user_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/master_user_list") ?>/'+p,
            data: $('#formtambah').serialize()+'&search='+$('#search').val(),
            cache: false,
            success: function(data) {
                $('#user_list').html(data);
            }
        });
    }

    function edit_user(id, username){
        $('#judul_dialog').html('Edit');
        $('input[name=id]').val(id);
        $('#user').val(username);
        $('#form_tambah').modal('show');
    }

    function edit_privileges_user(id){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/get_privileges") ?>/'+id,
            cache: false,
            success: function(data) {
                $('#priv_body').html(data);
                $('#form_priv').modal();
                $('input[name=id_user]').val(id);
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
    <div class="col-lg-8" style="padding-left:0px;">
        <?= form_button('tambah', '<span class="fa fa-plus-circle"> Tambah</span>', 'class="btn btn-primary" id="bt_add"') ?>
        <?= form_button('tambah', '<span class="fa fa-refresh"> Reset</span>', 'class="btn" id="bt_reset"') ?>
    </div>
    <div class="col-lg-4">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Username..." onkeyup="get_user_list(1)" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" >
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div>
    <br/><br/>
	<div id="user_list" style="width:100%"></div>
</div>

<div id="form_tambah" class="modal fade">
     <?= form_open('','id=formtambah class="form-horizontal"') ?>
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span id="judul_dialog"></span> Data User</h4>
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

<div id="form_priv" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit User Privileges</h4>
          </div>
        <div class="modal-body">
             <?= form_hidden('id_user') ?>
             <div id="priv_body"></div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="bt_save" onclick="save_priv_data()">Simpan</button>
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->