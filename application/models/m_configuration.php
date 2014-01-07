<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_configuration extends CI_Model {

	function load_home_slide(){
		$sql = "select * from home_slide order by id desc limit 0, 5";
		$menu = $this->db->query($sql)->result();
		return $menu;
	}

	
	
}
