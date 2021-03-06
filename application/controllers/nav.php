<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nav extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$this->load->model('m_admin');
		$data['page'] = 'home';
		$data['title'] = 'Home';
		$data['slide'] = $this->m_configuration->load_home_slide();
		$artikel = $this->m_admin->artikel_get_data(6, 0, null);
		$data['artikel'] = $artikel['data'];
		$this->m_data->add_visitor();
		$data['artikel_populer'] = $this->m_admin->artikel_populer();
		$this->load->view('front/layout', $data);
	}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */