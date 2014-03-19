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
        $num = 0;
		foreach ($jalur as $key => $value) {
           // echo print_r($value);
			$jalur[$num]->rute_detail = $this->get_rute_trans_jogja($value->id_shelter_awal, $value->id_shelter_akhir, $value->intersect, $value->id_jalur_awal, $value->id_jalur_akhir);
            foreach ($jalur[$num]->rute_detail as $key2 => $value2) {
                if (isset($value2->jarak_tempuh)) {
                    $jalur[$num]->jarak_tempuh += $value2->jarak_tempuh;
                }
                
                //echo $value2->jarak_tempuh."<br/>";
            }
            $num++;
		}
		die(json_encode($jalur));
	}

	private function get_rute_trans_jogja($shelter_awal, $shelter_akhir, $intersect, $jalur_awal, $jalur_akhir){
        /*
        $shelter_awal = get_safe('shelter_awal');
        $shelter_akhir = get_safe('shelter_akhir');
        $jalur_awal = get_safe('jalur_awal');
        $jalur_akhir = get_safe('jalur_akhir');
        $intersect = get_safe('intersect');
        */

        
        if ($intersect === '0') {
            $intersect = $shelter_akhir;
        }

        if($jalur_akhir === ''){
            $data[0] = $this->get_koordinat_rute_detail($jalur_awal, $shelter_awal, $shelter_akhir);
            $data[1] = array();
        }else{
            $data[0] = $this->get_koordinat_rute_detail($jalur_awal, $shelter_awal, $intersect);
            $data[1] = $this->get_koordinat_rute_detail($jalur_akhir, $intersect, $shelter_akhir);
        }
     
        
        return $data;
	}

    private function get_koordinat_rute_detail($id_jalur, $awal, $batas){
        $rute = $this->m_admin->get_koordinat_rute_with_limit($id_jalur, $awal, $batas);
        $jalur_trans = array();
        $shelter = array();
        $jarak = 0;
        //echo print_r($rute);
        foreach ($rute as $key => $val) {
            if ($key > 0) {
                $shelter[] = $this->m_admin->get_shelter($val->id_shelter);
                $relasi = $this->m_admin->get_relasi_shelter2($rute[$key - 1]->id_shelter, $val->id_shelter);

                if (sizeof($relasi) > 0) {
                     foreach (json_decode($relasi->jalur) as $key => $val2) {
                        $jalur_trans[] = $val2;
                    }
                    $jarak += (double)$relasi->jarak;
                }
               
            }
        }

        return (Object)array('rute' => $jalur_trans, 'shelter' => $shelter, 'jarak_tempuh'=>$jarak);
    }

    function count_jarak(){
        $this->m_data->count_jarak();    
    }
    
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */