<?php

class M_data extends CI_Model{
	function get_artikel_by_url($url){
        $sql = "select a.*, u.username, m.nama as museum, m.url as url_museum
        	from artikel a
            join users u on (u.id = a.id_user)
            left join museum m on (m.id = a.id_museum) 
            where a.url = '".$url."'";

       	//echo $sql;
        return $this->db->query($sql)->row();
    }

    function get_museum_by_url($url){
        $sql = "select * from museum where url = '".$url."'";

       	//echo $sql;
        return $this->db->query($sql)->row();
    }
}

?>