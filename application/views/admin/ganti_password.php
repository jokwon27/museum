<script type="text/javascript">
	$(function(){
		$("#baru, #confirm, #bt_simpan").attr("disabled","disabled");
		$('#form').submit(function(){
			return false;
		});

		$("#bt_simpan").click(function(){
			$.ajax({
	            type : 'POST',
	            url: '<?= base_url("admin/simpan_password") ?>',
	            cache: false,
	            data: $("#form").serialize(),
	            dataType : "json",
	            success: function(data) {
	            	message_edit_succes();
	            	$('.form-control').val('');
	            	$("#baru, #confirm, #bt_simpan").attr("disabled","disabled");
			    }
	        });
		})

	});

	function cek_password(){
		$.ajax({
            type : 'POST',
            url: '<?= base_url("admin/cek_password") ?>'+'/'+$("#id_user").val(),
            cache: false,
            data: "password="+$("#lama").val(),
            dataType : "json",
            success: function(data) {
            	if (data.status==true) {
            		$("#baru, #confirm").removeAttr("disabled");
            	}else {
            		$("#baru, #confirm, #bt_simpan").attr("disabled","disabled");
            	}
		    }
        });
	}

	function konfirmasi(){
		var baru=$("#baru").val();
		var confirm=$("#confirm").val();

		if (baru === confirm) {
			$("#bt_simpan").removeAttr("disabled");

		} else {
			$("#bt_simpan").attr("disabled","disabled");
		};
	}
</script>
<div class="col-lg-6">
	<?= form_open("","id=form")?>
	<input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>">
	<div class="form-group">
	    <label class="col-lg-4 control-label">Password Lama</label>
	    <div class="col-lg-8">
	    <?= form_password('lama','','class="form-control myinput" id=lama onkeyup=cek_password()')?>
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-lg-4 control-label">Password Baru</label>
	    <div class="col-lg-8">
	    <?= form_password('baru','','class="form-control myinput" id=baru')?>
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-lg-4 control-label">Confirm Password Baru</label>
	    <div class="col-lg-8">
	    <?= form_password('confirm','','class="form-control myinput" id=confirm onkeyup=konfirmasi()')?>
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-lg-4 control-label"></label>
	    <div class="col-lg-8">
	    	<button class="btn btn-primary" id="bt_simpan"><i class="fa fa-save"></i> Simpan</button>
	    	<button class="btn btn-default" id="bt_reset"><i class="fa fa-refresh"></i> Reset</button>
	    </div>
	</div>
	<?= form_close()?>
</div>