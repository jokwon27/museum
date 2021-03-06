<script type="text/javascript">
	$(function(){
		get_user_list(1);
        $('#bt_reset').click(function(){
            reset_data();
            get_user_list(1);
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
        if ($('#user').val() == '') {
            dc_validation('#user', 'Username harus diisi!');
            stop = true; 
        }

        if (stop) {
            return false;
        };
        
        $.ajax({
            type : 'POST',
            url: '<?= base_url("admin/user_save") ?>/', 
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
        $('input[name=id], #user, #search').val('');
        dc_validation_remove('.myinput');
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
            url: '<?= base_url("admin/user_list") ?>/'+p,
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
                            url: '<?= base_url("admin/user_delete") ?>/'+id+'/'+page,
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

    function reset_password(){
            var id=$('input[name=id]').val();
            BootstrapDialog.show({
                title: 'Reset Password',
                closable:true,
                type: BootstrapDialog.TYPE_DEFAULT,
                message: 'Apakah Anda Yakin Ingin Mereset Password? <br> Password default = 1234',
                buttons: [
                {
                    label: '<i class="fa fa-refresh"></i> Batal',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                },
                {
                    label: '<i class="fa fa-refresh"></i> Reset',
                    cssClass: 'btn-primary',
                    action: function(dialogItself){
                         $.ajax({
                            type : 'GET',
                            url: '<?= base_url("admin/reset_password") ?>/'+id+'/',
                            cache: false,
                            success: function(data) {
                                message_custom('success', 'Reset Password', 'anda berhasil mereset password', '');
                            },
                            error: function(){
                                message_custom('error', 'Reset Password', 'reset password GAGAL', '');
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
            <?= form_input('user','','class="form-control myinput" id=user')?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-6">
            <label style="margin:7px;">**********</label> <button type="button" class="btn btn-primary btn-xs" id="bt_reset_pass" onclick="reset_password()"><i class='fa fa-refresh'></i> Reset Password</button>
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
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
            <button type="button" class="btn btn-primary" id="bt_save" onclick="save_priv_data()"><i class="fa fa-save"></i> Simpan</button>
          </div>  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->