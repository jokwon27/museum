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
        $data = array();
		$jalur = $this->m_data->get_rute($shelter_user, $shelter_museum);
		foreach ($jalur as $key => $value) {
			$data[] = $this->m_admin->get_trans($value);;
		}
		die(json_encode($jalur));
	}

	function get_rute_trans_jogja(){
        $shelter_awal = get_safe('shelter_awal');
        $shelter_akhir = get_safe('shelter_akhir');
        $jalur_awal = get_safe('jalur_awal');
        $jalur_akhir = get_safe('jalur_akhir');
        $intersect = get_safe('intersect');


        
        /*
     	foreach ($rute as $key => $v) {
     		if ($v->id_shelter !== $shelter_user) {
     			unset($rute[$key]);
     			break;
     		}
     	}*/
        if ($intersect === '') {
            $intersect = $shelter_akhir;
        }

        $data[0] = $this->get_koordinat_rute_detail($jalur_awal, $intersect);
        $data[1] = $this->get_koordinat_rute_detail($jalur_akhir, $shelter_akhir);
        die(json_encode($data));
	}

    private function get_koordinat_rute_detail($id_jalur, $batas){
        $rute = $this->m_admin->get_koordinat_rute($id_jalur);
        $jalur_trans = array();
        $shelter = array();

        foreach ($rute as $key => $val) {
            if ($key > 0) {
                $shelter[] = $this->m_admin->get_shelter($val->id_shelter);
                $relasi = $this->m_admin->get_relasi_shelter2($rute[$key - 1]->id_shelter, $val->id_shelter);

                foreach (json_decode($relasi->jalur) as $key => $val2) {
                    $jalur_trans[] = $val2;
                }

                if ($val->id_shelter === $batas) {
                    break;
                }
            }
        }

        return array('rute' => $jalur_trans, 'shelter' => $shelter);
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */