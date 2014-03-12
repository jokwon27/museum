<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peta extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data', 'm_admin'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$data['title'] = 'Peta';
		$data['page'] = 'peta';
		$this->load->view('front/layout', $data);
	}

	function get_nearest_shelter($latitude, $longitude){
		$data = $this->m_data->get_nearest_shelter($latitude, $longitude);
		die(json_encode($data));
	}

	function get_rute($shelter_user, $shelter_museum){
		// array
		$jalur = $this->m_data->get_rute($shelter_user, $shelter_museum);
		foreach ($jalur as $key => $value) {
			$data[] = $this->m_admin->get_trans($value);;
		}
		die(json_encode($data));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */