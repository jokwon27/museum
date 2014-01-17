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
</script>

<div>
	
	<div id="user_list" style="width:50%"></div>
</div>