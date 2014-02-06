<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data', 'm_admin'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$data['title'] = 'Artikel';
		$data['page'] = 'artikel';
		$artikel = $this->m_admin->artikel_get_data(7, 0, null);
		$data['artikel'] = $artikel['data'];
		$this->load->view('front/layout', $data);
	}


	function detail($url = null){
		$data['page'] = 'artikel_detail';
		$data['artikel'] = $this->m_data->get_artikel_by_url($url);
		$this->load->view('front/layout', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */