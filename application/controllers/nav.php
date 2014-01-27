<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nav extends CI_Controller {

	function index(){
		$this->load->model('m_admin');
		$data['page'] = 'home';
		$data['title'] = 'Home';
		$data['slide'] = $this->m_configuration->load_home_slide();
		$artikel = $this->m_admin->artikel_get_data(3, 0, null);
		$data['artikel'] = $artikel['data'];
		$this->load->view('front/layout', $data);
	}

	function museum(){
		$data['title'] = 'Museum';
		$data['page'] = 'museum';
		$this->load->view('front/layout', $data);
	}

	function trans_jogja(){
		$data['title'] = 'Trans Jogja';
		$data['page'] = 'trans_jogja';
		$this->load->view('front/layout', $data);
	}

	function acara(){
		$data['title'] = 'Acara';
		$data['page'] = 'acara';
		$this->load->view('front/layout', $data);
	}


	function peta(){
		$data['title'] = 'Peta';
		$data['page'] = 'peta';
		$this->load->view('front/layout', $data);
	}




	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */