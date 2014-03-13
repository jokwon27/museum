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
    function get_jarak($mylongitude, $longitude, $mylatitude, $latitude){
        return sqrt(pow(($mylongitude - $longitude), 2) + pow(($mylatitude - $latitude), 2)) * 100;
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
            

            $selisih = $this->get_jarak($mylongitude, $value->longitude, $mylatitude, $value->latitude);
          

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
        $sql = "select * from koordinat_rute
                where id_shelter = '".$shelter_user."' 
                or id_shelter = '".$shelter_museum."'
                order by id_jalur, id";
        $query = $this->db->query($sql)->result();

      
        $jalur =  array();
        
        foreach ($query as $key => $value) {
            if ($key === 0) {
                
                $rute[0] = $value;
            }else{
                if($query[$key - 1]->id_jalur == $value->id_jalur){
                   $jalur[] = $value->id_jalur;
                }
            }

        }

        return $jalur;
        
    }
}

?>