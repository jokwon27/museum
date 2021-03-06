<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_admin'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

    function show_dashboard($data){
  
        $id_user = $this->session->userdata('id_user');
        $data['menu'] = $this->m_admin->menu_load_data($id_user);
        $this->load->view('admin/layout', $data);
       
    }

    function login() {
        $jml = $this->m_admin->cek_login();
        if (isset($jml->username) and $jml->username != '') {
            $data = array(
                'id_user' => $jml->id, 
                'user' => $jml->username, 
                'pass' => $jml->password
            );
            $this->session->set_userdata($data);
            //session_start();
            //$_SESSION['kcfinder'] = FALSE;
            die(json_encode(array('status'=>'login')));
        } else {
            die(json_encode(array('status'=>'gagal')));
        }
    }

    function logout() {
        $this->session->sess_destroy();
        //session_start();
        //session_unset('kcfinder');
        redirect(base_url('admin'));
    }

    function cek(){
        $user = $this->session->userdata('user'); 

        if ($user == '') {
            redirect(base_url('admin/sign_in'));
        }
    }

    function sign_in(){
         $this->load->view('admin/login');
    }

        function ganti_password() {
        $this->cek();
        $data['title'] = 'Ganti Password';
        $data['page'] = 'ganti_password';
        $data['id_user'] = $this->session->userdata('id_user');
        $this->show_dashboard($data);
    }

    function cek_password($id_user) {
        $parameter = array(
            'id' => $id_user, 
            'password' => post_safe('password'), 
        );  
        $status=$this->m_admin->cek_password($parameter);
        die(json_encode(array('status'=>$status)));
    }

    function simpan_password(){
        $parameter = array(
            'id' => post_safe("id_user"), 
            'password' => md5(post_safe('baru')), 
        );  
        $this->m_admin->simpan_password($parameter);
        die(json_encode(array('status'=>true)));  
    }

    function reset_password($id_user){
        $parameter = array(
            'id' => $id_user, 
            'password' => md5('1234')
        );  
        $this->m_admin->simpan_password($parameter);
        die(json_encode(array('status'=>true)));  
    }

	function index(){
        $this->cek();
        $data['title'] = 'Home';
        $data['page'] = 'home';
        $data['total_artikel'] = $this->db->get('artikel')->num_rows();
        $data['total_museum'] = $this->db->get('museum')->num_rows();
        $data['museum_populer'] = $this->m_admin->museum_populer();
        $data['artikel_populer'] = $this->m_admin->artikel_populer();
		$this->show_dashboard($data);
	}
    
    /* User */
    function user(){
        $this->cek();
        $data['title'] = 'User';
        $data['page'] = 'user/user';
        $this->show_dashboard($data);
    }

    function user_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'username' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->user_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->user_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/user/user_list', $data);

    }

    function user_save(){
        $id = $this->m_admin->user_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function user_delete($id,$page) {
        $this->cek();
        $this->m_admin->user_delete_data($id);
        $this->user_list($page);
    }

    function get_privileges($id){
        $data['username'] = $this->db->where('id', $id)->get('users')->row()->username;
        $data['user_priv'] = $this->m_admin->user_privileges_data($id);
        $data['privileges'] = $this->m_admin->privileges_get_data();
        $this->load->view('admin/user/user_privileges', $data);
    }

    function save_privileges($id_user){
        $add = array(
            'privileges' => post_safe('data'),
            'id_user' => $id_user
        );

        $hasil = $this->m_admin->user_privileges_edit_data($add);
        die(json_encode(array('status'=>$hasil)));
    }
    /* User */


    /* Museum */
    function museum(){
        $this->cek();
        $data['title'] = 'Museum';
        $data['page'] = 'museum/museum';
        $this->show_dashboard($data);
    }

    function museum_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'nama' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->museum_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->museum_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/museum/museum_list', $data);

    }

    function museum_save(){
        $id = $this->m_admin->museum_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function museum_delete($id,$page) {
        $this->cek();
        $this->m_admin->museum_delete_data($id);
        $this->museum_list($page);
    }

    function museum_data($id){
         $data = $this->m_admin->get_museum($id);
         die(json_encode($data));
    }

    function museum_preview($id){
        $data['museum'] = $this->m_admin->get_museum($id);
        $this->load->view('admin/museum/museum_preview', $data);
    }


    /* Museum */

    /* Shelter */
    function shelter(){
        $this->cek();
        $data['title'] = 'Shelter';
        $data['page'] = 'shelter/shelter';
        $this->show_dashboard($data);
    }

    function shelter_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'nama' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->shelter_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->shelter_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/shelter/shelter_list', $data);

    }

    function shelter_save(){
        $id = $this->m_admin->shelter_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function shelter_delete($id,$page) {
        $this->cek();
        $this->m_admin->shelter_delete_data($id);
        $this->shelter_list($page);
    }

    function shelter_data($id){
         $data = $this->m_admin->get_shelter($id);
         die(json_encode($data));
    }

    function get_all_shelter(){
        $data = $this->db->get('shelter')->result();
        die(json_encode($data));
    }

    function get_koordinat_shelter($id_shelter1, $id_shelter2){
        $sql = "select * from relasi_shelter where 
                id_shelter_awal = '".$id_shelter1."' 
                and id_shelter_tujuan = '".$id_shelter2."' ";

        $data = $this->db->query($sql)->row();
        if (sizeof($data) == 0) {
            $data = null;
        }
        die(json_encode($data));
    }
    /* Shelter */

    /* Artikel */
    function artikel(){
        $this->cek();
        $data['title'] = 'Artikel';
        $data['page'] = 'artikel/artikel';
        $this->show_dashboard($data);
    }

    function artikel_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'judul' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->artikel_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->artikel_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/artikel/artikel_list', $data);

    }

    function artikel_save(){
        $id = $this->m_admin->artikel_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function artikel_delete($id,$page) {
        $this->cek();
        $this->m_admin->artikel_delete_data($id);
        $this->artikel_list($page);
    }

    function artikel_preview($id){
        $data['artikel'] = $this->m_admin->get_artikel($id);
        $this->load->view('admin/artikel/artikel_preview', $data);
    }

    function artikel_data($id){
         $data = $this->m_admin->get_artikel($id);
         die(json_encode($data));
    }

    /* Artikel */

    /* Trans Jogja */
    function trans(){
        $this->cek();
        $data['title'] = 'Rute Trans Jogja';
        $data['page'] = 'trans/trans';
        $this->show_dashboard($data);
    }

    function trans_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'nama' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->trans_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->trans_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/trans/trans_list', $data);

    }

    function trans_save(){
        $id = $this->m_admin->trans_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function trans_delete($id,$page) {
        $this->cek();
        $this->m_admin->trans_delete_data($id);
        $this->trans_list($page);
    }

    function trans_data($id){
         $data = $this->m_admin->get_trans($id);
         die(json_encode($data));
    }
    /* Trans Jogja */

    function slide(){
        $this->cek();
        $data['title'] = 'Slide';
        $data['page'] = 'slide';
        $this->show_dashboard($data);
    }

    /* Relasi Shelter */

    function relasi_shelter(){
        $this->cek();
        $data['title'] = 'Relasi Shelter';
        $data['page'] = 'shelter/relasi_shelter';
        $this->show_dashboard($data);
    }

    function relasi_shelter_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'nama' => get_safe('search')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->relasi_shelter_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->relasi_shelter_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/shelter/relasi_shelter_list', $data);

    }

    function relasi_shelter_save(){
        $id = $this->m_admin->relasi_shelter_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function relasi_shelter_cek($awal, $tujuan){
        $cek = $this->m_admin->cek_relasi_shelter($awal, $tujuan);
        
        die(json_encode(array('cek'=>$cek)));
    }

    function relasi_shelter_delete($id,$page) {
        $this->cek();
        $this->m_admin->relasi_shelter_delete_data($id);
        $this->relasi_shelter_list($page);
    }

    function relasi_shelter_data($id){
         $data = $this->m_admin->get_relasi_shelter($id);
         die(json_encode($data));
    }

    /* Relasi Shelter */

    function get_total_pengunjung() {
        $date   = mktime(0, 0, 0, date("m"), date("d")-7, date("Y"));
        $start  = date("Y-m-d", $date);
        $result = $this->m_admin->get_visitor($start)->result();
        $data   = array();
        $juml   = array();
        foreach ($result as $hasil) {
            $data[] = indo_tgl_graph($hasil->MyJoinDate);
            $juml[] = (int)$hasil->jumlah;
        }
        die(json_encode(array('tanggal' => $data, 'jumlah' => $juml)));
    }

    function upload_tumbnail($folder){
        $status = "";
        $msg = "";
        $file_element_name = 'tumbnail';
         
        if ($status != "error")
        {   
            //$config['file_name'] = $_POST['title'];
            $config['upload_path'] = './image_upload/'.$folder.'/';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
     
            $this->load->library('upload', $config);
     
            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['']);
                if(true)
                {
                    $status = "success";
                    $msg = "File successfully uploaded";
                }
                else
                {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'filename' =>$data['file_name']));
    }

    function galery_list($id_museum){
        $data['museum'] = $this->m_admin->get_museum($id_museum);
        $data['galery'] = $this->db->where('id_museum', $id_museum)->get('gallery')->result();
        $this->load->view('admin/museum/galery', $data);
    }

    function galery_delete($id, $folder){
        $galery = $this->db->where('id', $id)->get('gallery')->row();
        $path = PUBPATH."image_upload/gallery/".$folder."/".$galery->url;
        unlink($path);

        echo $path;

        //$this->db->where('id', $id)->delete('gallery');

    }

    
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */