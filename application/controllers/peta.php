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

	function get_rute_trans_jogja($id_jalur,$shelter_user, $shelter_museum){
		$rute = $this->m_admin->get_koordinat_rute($id_jalur);
        $jalur_trans = array();
        $shelter = array();
        /*
     	foreach ($rute as $key => $v) {
     		if ($v->id_shelter !== $shelter_user) {
     			unset($rute[$key]);
     			break;
     		}
     	}*/
     	$rute = array_values($rute);
        foreach ($rute as $key => $val) {
            if ($key > 0) {
            	$shelter[] = $this->m_admin->get_shelter($val->id_shelter);
                $relasi = $this->m_admin->get_relasi_shelter2($rute[$key - 1]->id_shelter, $val->id_shelter);

                foreach (json_decode($relasi->jalur) as $key => $val2) {
                    $jalur_trans[] = $val2;
                }

                if ($val->id_shelter === $shelter_museum) {
            		break;
            	}
            }
        }
        $data['shelter'] = $shelter;
        $data['jalur'] = $jalur_trans;
        $data['detail'] = $this->m_admin->get_trans($id_jalur);
        die(json_encode($data));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */