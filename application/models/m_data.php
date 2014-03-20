<?php

class M_data extends CI_Model{

    function add_visitor(){
        $data = array(
                'waktu' =>  date('Y-m-d H:i:s')
            );

        $this->db->insert('visitor_counter', $data);
    }

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

    function get_galery_museum($id_museum){
        return $this->db->where('id_museum', $id_museum)->get('gallery')->result();
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

    function get_shelter_terdekat($intersect, $id_shelter_tujuan ){
        $near = 1000000;
        $shelter_intersect = 0;
        // intersect = array shelter
        
        $tujuan = $this->m_admin->get_shelter($id_shelter_tujuan);
        $num = 0;
        if($id_shelter_tujuan == '24'){
            echo print_r($intersect);
        }
        foreach ($intersect as $key => $val) {
            if($key > 0){
                $shelter = $this->m_admin->get_shelter($val);

                $selisih = sqrt(pow(((double)$tujuan->longitude - (double)$shelter->longitude), 2) + pow(((double)$tujuan->latitude - (double)$shelter->latitude), 2)) * 100;

                 if($selisih < $near){
                    $near = $selisih;
                    $shelter_intersect = $val;
                 }

            }

             $num++;
        }

        return $shelter_intersect;
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
                        $shelter_intersect = $value;
                        break;
                    }

                    $shelter_intersect = $this->get_shelter_terdekat($intersect, $shelter_museum);
                    $shelter_intersect_nama = $this->m_admin->get_shelter($shelter_intersect);
                    
                    $judul = $v1->jalur." - ".$v2->jalur;
                    $rangkaian_jalur = "Dari ".$v1->jalur." pindah ke ".$v2->jalur;
                    $jal_akhir = $v2->id_jalur;
                }else{
                    $judul = $v1->jalur;
                    $rangkaian_jalur = $v1->jalur;
                    $jal_akhir = '';
                }

                if($shelter_museum !== $shelter_intersect){
                   $jalur[] = (Object) array(
                        'id_jalur_awal' => $v1->id_jalur,
                        'id_jalur_akhir' => $jal_akhir,
                        'id_shelter_awal' => $shelter_user,
                        'id_shelter_akhir' => $shelter_museum,
                        'jalur_awal' => $v1->jalur,
                        'jalur_akhir' => $v2->jalur,
                        'titik_oper' => $shelter_intersect_nama,
                        'intersect' => $shelter_intersect,
                        'rangkaian_jalur' => $rangkaian_jalur,
                        'judul' => $judul,
                        'rute_detail' => null,
                        'jarak_tempuh' => 0

                    ); 
                }
                
                $intersect = null;
                $shelter_intersect = null;
                $shelter_intersect_nama = '';
            }

        }
        return $jalur;
        
    }

    function count_jarak(){
        $relasi_shelter = $this->db->get('relasi_shelter')->result();
        $jarak = 0;
        foreach ($relasi_shelter as $key => $rs) {
            $jarak = 0;
            $jalur = json_decode($rs->jalur);
            foreach ( $jalur as $key2 => $koord) {
                if ($key2 > 0) {
                    $selisih = sqrt(pow(( $jalur[$key2-1]->e - $koord->e), 2) + pow(($jalur[$key2-1]->d - $koord->d), 2)) * 100;
                    
                    $jarak += $selisih;
                    
                }
            }

            // update jarak

            $update = array('jarak' => round($jarak, 1) );
            $this->db->where('id', $rs->id)->update('relasi_shelter', $update);
        }
    }

    function get_artikel_archive(){
        $sql = "select year(waktu) as tahun,
                 count(*) as jumlah , null as list_bulan
                 from artikel
                group by year(waktu)";

        $archive = $this->db->query($sql)->result();

        foreach ($archive as $k => $v) {
            $sql_month = "select month(waktu) as bulan , monthname(waktu) as nama_bulan,
                 count(*) as jumlah , null as list_artikel
                 from artikel 
                 where year(waktu) = '".$v->tahun."'
                group by month(waktu)";
            $archive[$k]->list_bulan = $this->db->query($sql_month)->result();

            foreach ($archive[$k]->list_bulan as $key => $value) {
                $sql2 = "select url, judul from artikel where month(waktu) = '".$value->bulan."' ";
                $archive[$k]->list_bulan[$key]->list_artikel = $this->db->query($sql2)->result();
            }

        }

        

        return $archive;
    }

    function update_hit($table, $url){
        $data = $this->db->where('url', $url)->get($table)->row();

        $hit = 0;
        if ($data !== null) {
            $hit = $data->hit;
        }
        
        $update = array('hit'=> ++$hit);
        $this->db->where('url', $url)->update($table, $update);

    }
}

?>