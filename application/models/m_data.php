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

    function get_nearest_shelter($mylatitude, $mylongitude){
        $shelter = $this->db->get('shelter')->result();
        $terdekat = 100000;
        $data['id_shelter'] = null;
        $data['shelter'] = null;
        $data['longitude'] = null;
        $data['latitude'] = null;

        foreach ($shelter as $key => $value) {
            

            $selisih = sqrt(pow(($mylongitude - $value->longitude), 2) + pow(($mylatitude - $value->latitude), 2)) * 100;
          

            if($terdekat > $selisih){
                $terdekat = $selisih;

                $data['id_shelter'] = $value->id;
                $data['shelter'] = $value->nama;
                $data['longitude'] = $value->longitude;
                $data['latitude'] = $value->latitude;
            }
        }

        return $data;
    }


    function get_rute($shelter_user, $shelter_museum){

    }
}

?>