<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peta extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$data['title'] = 'Peta';
		$data['page'] = 'peta';
		$this->load->view('front/layout', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */