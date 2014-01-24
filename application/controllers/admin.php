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

            die(json_encode(array('status'=>'login')));
        } else {
            die(json_encode(array('status'=>'gagal')));
        }
    }

    function logout() {
        $this->session->sess_destroy();
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

	function index(){
        $this->cek();
        $data['title'] = 'Home';
        $data['page'] = 'home';
		$this->show_dashboard($data);
	}
    
    /* User */
    function master_user(){
        $this->cek();
        $data['title'] = 'Master Data User';
        $data['page'] = 'user/user';
        $this->show_dashboard($data);
    }

    function master_user_list($page){
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

    function master_user_save(){
        $id = $this->m_admin->user_save_data();
        die(json_encode(array('id'=>$id)));
    }

    function master_user_delete($id,$page) {
        $this->cek();
        $this->m_admin->user_delete_data($id);
        $this->master_user_list($page);
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
    function master_museum(){
        $this->cek();
        $data['title'] = 'Master Data Museum';
        $data['page'] = 'museum/museum';
        $this->show_dashboard($data);
    }


    /* Museum */

    /* Trans Jogja */
    function master_trans(){
        $this->cek();
        $data['title'] = 'Master Data Trans Jogja';
        $data['page'] = 'trans/trans';
        $this->show_dashboard($data);
    }
    /* Trans Jogja */

    /* Shelter */
    function master_shelter(){
        $this->cek();
        $data['title'] = 'Master Data Shelter';
        $data['page'] = 'shelter/shelter';
        $this->show_dashboard($data);
    }
    /* Shelter */

    /* Artikel */
    function master_artikel(){
        $this->cek();
        $data['title'] = 'Master Data Artikel';
        $data['page'] = 'artikel/artikel';
        $this->show_dashboard($data);
    }

    function master_artikel_list($page){
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

    function master_artikel_delete($id,$page) {
        $this->cek();
        $this->m_admin->artikel_delete_data($id);
        $this->master_artikel_list($page);
    }

    function artikel_preview($id){
        $data['artikel'] = $this->m_admin->get_artikel($id);
        $this->load->view('admin/artikel/artikel_preview', $data);
    }

    /* Artkel */

    function master_slide(){
        $this->cek();
        $data['title'] = 'Master Data Slide';
        $data['page'] = 'master_slide';
        $this->show_dashboard($data);
    }


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */