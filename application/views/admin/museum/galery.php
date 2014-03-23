<link rel="stylesheet" href="<?= base_url() ?>assets/gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gallery/css/bootstrap-image-gallery.min.css"><?php if(($museum->folder_gallery !== null) & (sizeof($galery) > 0)): ?>
<div id="links">
	<table class="table">
		<?php foreach ($galery as $key => $value): ?>
		<tr>
			<td align="center" width="5%"><?= ++$key ?></td>
			<td width="35%"><?= $value->judul?></td>
			<td width="50">
				<a href="<?= base_url() ?>image_upload/gallery/<?= $museum->folder_gallery ?>/<?= $value->url ?>" title="<?= $value->judul ?>" data-gallery>
			        <img src="<?= base_url() ?>image_upload/gallery/<?= $museum->folder_gallery ?>/<?= $value->url ?>" alt="<?= $value->judul ?>" width="100" width="100">
			    </a>
			</td>
	    	<td width="10%">
	    		<button type="button" class="btn btn-default btn-xs" onclick="hapus_galery( <?= $value->id ?> ,'<?= $museum->folder_gallery ?>' , this)"><i class="fa fa-trash-o"></i> hapus</button>
	    	</td>
	    </tr>
		<?php endforeach; ?>
	</table>
</div>
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                   
                    </button>
                    <button type="button" class="btn btn-primary next">
                        
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

	

<script src="<?= base_url() ?>assets/gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?= base_url() ?>assets/gallery/js/bootstrap-image-gallery.min.js"></script>
<script type="text/javascript">
	function removeMe(el) {
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
    }

    function hapus_galery(id, folder, obj){
    	BootstrapDialog.show({
            title: 'Hapus Gambar',
            closable:true,
            type: BootstrapDialog.TYPE_DEFAULT,
            message: 'Anda yakin akan menghapus gambar ini?',
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
                        url: '<?= base_url("admin/galery_delete") ?>/'+id+'/'+folder,
                        cache: false,
                        success: function(data) {
                            removeMe(obj);
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
</script>