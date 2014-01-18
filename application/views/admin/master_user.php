<script type="text/javascript">
	$(function(){
		get_user_list(1);

	});


    function get_user_list(p){
        $.ajax({
            type : 'GET',
            url: '<?= base_url("admin/master_user_list") ?>/'+p, 
            cache: false,
            success: function(data) {
                $('#user_list').html(data);
            }
        });
    }

    function delete_user(id){
            var page = ($('.noblock').html()=='')?'1':$('.noblock').html();
            BootstrapDialog.show({
                title: 'Hapus Data',
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
	
	<div id="user_list" style="width:50%"></div>
</div>