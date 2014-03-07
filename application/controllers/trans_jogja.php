<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trans_jogja extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_data', 'm_admin'));
        $this->load->library('session');
        $this->limit = 10;
        date_default_timezone_set('Asia/Jakarta');
    }

	function index(){
		$data['title'] = 'Trans Jogja';
		$data['page'] = 'trans_jogja';
        $jalur = $this->m_admin->trans_get_data(100, 0, null);
        $data['jalur'] = $jalur['data'];
		$this->load->view('front/layout', $data);
	}

	function get_rute_trans_jogja($id_jalur){
        $rute = $this->m_admin->get_koordinat_rute($id_jalur);
        $jalur_trans = array();

        foreach ($rute as $key => $val) {
            if ($key > 0) {
                $relasi = $this->m_admin->get_relasi_shelter2($rute[$key - 1]->id_shelter, $val->id_shelter);

                foreach (json_decode($relasi->jalur) as $key => $val2) {
                    $jalur_trans[] = $val2;
                }
            }
        }

        $data['jalur'] = $jalur_trans;
        $data['detail'] = $this->m_admin->get_trans($id_jalur);
        die(json_encode($data));
    }
	
    function get_all_shelter(){
        $data = $this->db->get('shelter')->result();
        die(json_encode($data));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */