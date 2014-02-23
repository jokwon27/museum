<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_autocomplete extends CI_Model {

	function get_data_museum($q){
	
        $sql = "select id, nama, alamat from museum 
        where nama like ('%$q%')  order by locate('$q', nama)";
        return $this->db->query($sql);
	}

	function get_data_shelter($q){
	
        $sql = "select * from shelter 
        where nama like ('%$q%')  order by locate('$q', nama)";
        return $this->db->query($sql);
	}

	
	
}
