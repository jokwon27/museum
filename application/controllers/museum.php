<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Museum extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$data['title'] = 'Museum';
		$data['page'] = 'museum';
		$this->load->view('front/layout', $data);
	}


	function detail($url = null){
		$data['page'] = 'museum_detail';
		$data['museum'] = $this->m_data->get_museum_by_url($url);
		$this->load->view('front/layout', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */