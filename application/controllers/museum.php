<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Museum extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data','m_admin'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		if (isset($_GET['page'])) {
			$page = get_safe('page');
		}else{
			$page = 1;
		}
		$nama = '';
		$page_nama = '';
		if (isset($_GET['pencarian'])) {
			$nama = get_safe('pencarian');
			$page_nama = '&pencarian='.$nama;
		}

		$search = array(
				'nama' => $nama
			);

		$start = ($page - 1) * $this->limit;

		$data['title'] = 'Museum';
		$data['page'] = 'museum';
		$museum = $this->m_admin->museum_get_data($this->limit, $start, $search);
		$data['museum'] = $museum['data'];
		$data['pagination'] = pagination_front($museum['jumlah'], $this->limit, $page,'museum', $page_nama);
		$this->load->view('front/layout', $data);
	}


	function detail($url = null){
		$data['page'] = 'museum_detail';
		if ($url !== null) {
			$data['museum'] = $this->m_data->get_museum_by_url($url);
			$data['gallery'] = $this->m_data->get_galery_museum($data['museum']->id);
			$this->m_data->update_hit('museum', $url);
		}
		$this->load->view('front/layout', $data);
		
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */