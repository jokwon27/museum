function message_delete_succes(){
	 $.pnotify({
            title: 'Hapus Data',
            text: 'Berhasil hapus data',
            type: 'success',
            delay : 3000,
            remove: true,
            closer:true,
        });
}

function message_add_succes(){
	 $.pnotify({
            title: 'Tambah Data',
            text: 'Berhasil tambah data',
            type: 'success',
            delay : 3000,
            remove: true,
            closer:true,
        });
}

function message_edit_succes(){
	 $.pnotify({
            title: 'Edit Data',
            text: 'Berhasil edit data',
            type: 'success',
            delay : 3000,
            remove: true,
            closer:true,
        });
}

function message_delete_failed(){
	 $.pnotify({
            title: 'Hapus Data',
            text: 'Gagal hapus data',
            type: 'error',
            icon:true,
            delay : 3000,
            remove: true,
            closer:true
        });
}

function message_add_failed(){
	 $.pnotify({
            title: 'Tambah Data',
            text: 'Gagal tambah data',
            type: 'error',
            icon:true,
            delay : 3000,
            remove: true,
            closer:true
        });
}

function message_edit_failed(){
	 $.pnotify({
            title: 'Edit Data',
            text: 'Gagal edit data',
            type: 'error',
            icon:true,
            delay : 3000,
            remove: true,
            closer:true
        });
}

function message_custom(tipe, judul, pesan){
	 $.pnotify({
            title: judul,
            text: pesan,
            type: tipe,
            icon:true,
            delay : 3000,
            remove: true,
            closer:true
        });
}