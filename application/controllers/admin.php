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

    function master_user(){
        $this->cek();
        $data['title'] = 'Master Data User';
        $data['page'] = 'master_user';
        $this->show_dashboard($data);
    }

    function master_user_list($page){
        $this->cek();
        $search = array(
                'id' => get_safe('id'),
                'username' => get_safe('user')
            );
        $start = ($page - 1) * $this->limit;        
        $data = $this->m_admin->user_get_data($this->limit, $start, $search);
        if ($data['data'] == NULL) {
            $data = $this->m_admin->user_get_data($this->limit, 0, $search);
        }
        $data['page'] = $page;
        $data['limit'] = $this->limit;
        $data['pagination'] = pagination($data['jumlah'], $this->limit, $page, 1);
        $this->load->view('admin/master_user_list', $data);

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

    function master_museum(){
        $this->cek();
        $data['title'] = 'Master Data Museum';
        $data['page'] = 'master_museum';
        $this->show_dashboard($data);
    }

    function master_trans(){
        $this->cek();
        $data['title'] = 'Master Data Trans Jogja';
        $data['page'] = 'master_trans';
        $this->show_dashboard($data);
    }

    function master_shelter(){
        $this->cek();
        $data['title'] = 'Master Data Shelter';
        $data['page'] = 'master_shelter';
        $this->show_dashboard($data);
    }

    function master_acara(){
        $this->cek();
        $data['title'] = 'Master Data Acara';
        $data['page'] = 'master_acara';
        $this->show_dashboard($data);
    }

    function master_slide(){
        $this->cek();
        $data['title'] = 'Master Data Slide';
        $data['page'] = 'master_slide';
        $this->show_dashboard($data);
    }


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */