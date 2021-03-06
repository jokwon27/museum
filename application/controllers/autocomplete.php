<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('m_autocomplete'));
        $this->load->library('session');
        date_default_timezone_set('Asia/Jakarta');
    }

	function get_museum(){
		$q = get_safe('q');
        $data = $this->m_autocomplete->get_data_museum($q)->result();
        die(json_encode($data));
	}

    function get_shelter(){
        $q = get_safe('q');
        $data = $this->m_autocomplete->get_data_shelter($q)->result();
        die(json_encode($data));
    }

	
}

