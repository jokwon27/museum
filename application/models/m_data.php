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
        $sql = "select *,
                ( SQRT(POW((".$mylongitude." - longitude), 2) + POW((".$mylatitude." - latitude), 2)) * 100 ) as selisih
                from shelter
                order by selisih";

        $shelter = $this->db->query($sql)->result();
        $terdekat = 100000;
        $data = array();

        foreach ($shelter as $key => $value) {
            if ($key < 2) {
                $data[] = $value;
            }else{
                break;
            }

        }

        return $data;
    }

    // KUDU DIBENAKKE MANING
    function get_rute($shelter_user, $shelter_museum){
        $sql_jalur_from_user = "select kr.*, j.nama as jalur from koordinat_rute kr
                join jalur j on (j.id = kr.id_jalur)
                where kr.id_shelter = '".$shelter_user."' 
                order by kr.id_jalur, kr.id";
        // echo $sql;
        $query_user = $this->db->query($sql_jalur_from_user)->result();

        $sql_jalur_from_museum = "select kr.*, j.nama as jalur from koordinat_rute kr
                join jalur j on (j.id = kr.id_jalur)
                where kr.id_shelter = '".$shelter_museum."' 
                order by kr.id_jalur, kr.id";
        // echo $sql;
        $query_museum = $this->db->query($sql_jalur_from_museum)->result();

      
        $jalur =  array();
        $rute1 =  array();
        $rute2 =  array();
        $intersect = null;
        $shelter_intersect = null;
        $shelter_intersect_nama = '';
        
        foreach ($query_user as $key1 => $v1) {
            foreach ($query_museum as $key => $v2) {
                if($v1->id_jalur !== $v2->id_jalur){
                    // Cari titik oper shelter
                    $query_rute1 = $this->db->where('id_jalur', $v1->id_jalur)->get('koordinat_rute')->result();
                    foreach ($query_rute1 as $key => $value) {
                        $rute1[] = $value->id_shelter; 
                    }

                    $query_rute2 = $this->db->where('id_jalur', $v2->id_jalur)->get('koordinat_rute')->result();
                    foreach ($query_rute2 as $key => $value) {
                        $rute2[] = $value->id_shelter; 
                    }

                    $intersect = array_intersect($rute1, $rute2);
                    $shelter_intersect_nama = '';
                    foreach ($intersect as $key => $value) {
                        if ($value !== $shelter_museum) {
                            $shelter_intersect = $value;
                            $shelter_intersect_nama = $this->m_admin->get_shelter($value)->nama;
                            break;
                        }
                    }
                    $judul = $v1->jalur." - ".$v2->jalur;
                    $rangkaian_jalur = "Dari ".$v1->jalur." pindah ke ".$v2->jalur;
                }else{
                    $judul = $v1->jalur;
                    $rangkaian_jalur = $v1->jalur;
                }

                $jalur[] = array(
                        'id_jalur_awal' => $v1->id_jalur,
                        'id_jalur_akhir' => $v2->id_jalur,
                        'jalur_awal' => $v1->jalur,
                        'jalur_akhir' => $v2->jalur,
                        'titik_oper' => $shelter_intersect_nama,
                        'intersect' => $shelter_intersect,
                        'rangkaian_jalur' => $rangkaian_jalur,
                        'judul' => $judul

                );
                $intersect = null;
                $shelter_intersect = null;
                $shelter_intersect_nama = '';
            }

        }

        return $jalur;
        
    }
}

?>