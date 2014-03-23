<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {
     function cek_login() {
        $sql = "select * from users u
        where u.username = '".post_safe('username')."' and u.password = '".md5(post_safe('password'))."'";
        //echo $query;
        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function cek_password($data) {
        $sql = "select * from users u
        where u.id = '".$data['id']."' and u.password = '".md5($data['password'])."'";
        //echo $query;
        $hasil=$this->db->query($sql);
        $num= $hasil->num_rows();
        if ($num>0) {
            $status=true;
        }
        else {
            $status=false;
        }
        return $status;
    }

    function simpan_password($data){
        $this->db->where('id',$data['id'])->update('users',$data);
    }

     function menu_load_data($id_user = null) {
        $q = null;
        if ($id_user != null) {
            $q.="and mp.user_id = '$id_user' ";
        }

       
        $sql = "select * from menu_user_privileges mp
            join menu_admin m on (mp.menu_admin_id = m.id)
            join users u on (mp.user_id = u.id)
            where mp.id is not null $q";
        //echo $sql;
        return $this->db->query($sql)->result();
    }

    /* User */
    function user_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and id = '".$search['id']."'";
        }

        if (isset($search['username']) && ($search['username'] !== '')) {
            $q = " and username like '%".$search['username']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select * from users where id is not null $q order by username";
        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function user_delete_data($id){
        $this->db->where('id', $id)->delete('users');
    }

    function user_save_data(){
        $data = array(
            'username' => post_safe('user')            
        );

        $id = post_safe('id');

        if ($id === '') {
            $data['password'] = md5('1234');
            $this->db->insert('users', $data);
            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id)->update('users', $data);
        }

        return $id;
    }

    function privileges_get_data() {
        $query = $this->db->get('menu_admin');
        return $query->result();
    }

    function user_privileges_data($id) {
        $sql = "select * from menu_user_privileges where 
             user_id = '" . $id . "'";
        //echo $sql;
        $query = $this->db->query($sql)->result();
        $data = array();
        foreach ($query as $value) {
            $data[] = $value->menu_admin_id;
        }
        return $data;
    }

    function user_privileges_edit_data($data) {
        $this->db->trans_begin();
        //delete privileges
        $this->db->where('user_id', $data['id_user']);
        $this->db->delete('menu_user_privileges');

        // add privileges
        if (is_array($data['privileges'])) {
            foreach ($data['privileges'] as $value) {
                $insert = array(
                    'user_id' => $data['id_user'],
                    'menu_admin_id' => $value
                );
                $this->db->insert('menu_user_privileges', $insert);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status = false;
        } else {
            $this->db->trans_commit();
            $status = true;
        }

        return $status;
    }

    /* User */


    /* Artikel */
    function artikel_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and a.id = '".$search['id']."'";
        }

        if (isset($search['judul']) && ($search['judul'] !== '')) {
            $q = " and a.judul like '%".$search['judul']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select a.*, u.username, m.nama as museum from artikel a
            join users u on (u.id = a.id_user)
            left join museum m on (m.id = a.id_museum)
            where a.id is not null $q order by id desc";
        
        //echo $sql.$limit;
        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function artikel_delete_data($id){
        $this->db->where('id', $id)->delete('artikel');
    }

    function artikel_save_data(){
        $data = array(
            'judul' => post_safe('judul'),
            'waktu' => date('Y-m-d H:i:s'),
            'id_user' => $this->session->userdata('id_user'),
            'id_museum' => post_safe('id_museum'),
            'url' => post_safe('url'),
            'isi' => post_safe('isi_artikel'),
            'image' => post_safe('nama_image')           
        );

        $id = post_safe('id');

        if ($id === '') {
            $this->db->insert('artikel', $data);
            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id)->update('artikel', $data);
        }

        return $id;
    }

    function get_artikel($id){
        $sql = "select a.*, u.username, m.nama as museum, m.url as url_museum
             from artikel a
            join users u on (u.id = a.id_user)
            left join museum m on (m.id = a.id_museum) 
            where a.id = '".$id."'";
        return $this->db->query($sql)->row();
    }

    /* Artikel */

     /* Artikel */
    function museum_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and id = '".$search['id']."'";
        }

        if (isset($search['nama']) && ($search['nama'] !== '')) {
            $q = " and nama like '%".$search['nama']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select * from museum
            where id is not null $q order by nama";
        

        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function museum_delete_data($id){
        $this->db->where('id', $id)->delete('museum');
    }

    function museum_save_data(){
        $data = array(
            'nama' => post_safe('nama'),
            'alamat' => post_safe('alamat'),
            'url' => post_safe('url'),
            'longitude' => post_safe('longitude'),
            'latitude' => post_safe('latitude'),
            'keterangan' => $_POST['keterangan_museum'],
            'link_youtube' => post_safe('link_youtube'),
            'folder_gallery' => post_safe('folder_gallery'),
            'image' => post_safe('nama_image')
        );

        $id = post_safe('id');

        if ($id === '') {
            $this->db->insert('museum', $data);
            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id)->update('museum', $data);
        }

        return $id;
    }

    function get_museum($id){
        $sql = "select * from museum
            where id = '".$id."'";
        return $this->db->query($sql)->row();
    }

    /* Artikel */

    /* Shelter */
    function shelter_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and id = '".$search['id']."'";
        }

        if (isset($search['nama']) && ($search['nama'] !== '')) {
            $q = " and nama like '%".$search['nama']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select * from shelter
            where id is not null $q order by nama";
        

        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function shelter_delete_data($id){
        $this->db->where('id', $id)->delete('shelter');
    }

    function shelter_save_data(){
        $data = array(
            'nama' => post_safe('nama'),
            'longitude' => post_safe('longitude'),
            'latitude' => post_safe('latitude')        
        );

        $id = post_safe('id');

        if ($id === '') {
            $this->db->insert('shelter', $data);
            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id)->update('shelter', $data);
        }

        return $id;
    }

    function get_shelter($id){
        $sql = "select * from shelter
            where id = '".$id."'";
        return $this->db->query($sql)->row();
    }
    /* Shelter */
    
    /* Rute Trans Jogja */
    function trans_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and id = '".$search['id']."'";
        }

        if (isset($search['nama']) && ($search['nama'] !== '')) {
            $q = " and nama like '%".$search['nama']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select * from jalur
            where id is not null $q order by nama";
        

        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function trans_delete_data($id){
        $this->db->where('id', $id)->delete('jalur');
    }

    function trans_save_data(){
        $data = array(
            'nama' => post_safe('nama'),
            'rute' => post_safe('rute')
        );

        $id = post_safe('id');

        
        $this->db->insert('jalur', $data);
        $id = $this->db->insert_id();
        
        $koord = post_safe('koordinat_rute');
       
       foreach (explode(',', $koord) as $key => $value) {
            $ins = array(
                    'id_jalur' => $id,
                    'id_shelter' => $value
                );
            $this->db->insert('koordinat_rute', $ins);
       }
       

        return $id;
    }

    function get_trans($id){
        $sql = "select * from jalur
            where id = '".$id."'";
        return $this->db->query($sql)->row();
    }
    /* Rute Trans Jogja */

    /* Relasi Shelter */
    function relasi_shelter_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q = " and rs.id = '".$search['id']."'";
        }

        if (isset($search['nama']) && ($search['nama'] !== '')) {
            $q = " and s1.nama like '%".$search['nama']."%' or s2.nama like '%".$search['nama']."%'";
        }
        $limit = " limit $start, $limit ";
        $sql = "select rs.*, s1.nama as shelter_awal,
            s2.nama as shelter_tujuan
            from relasi_shelter rs
            join shelter s1 on (s1.id = rs.id_shelter_awal)
            join shelter s2 on (s2.id = rs.id_shelter_tujuan)
            where rs.id is not null $q order by rs.id";
        

        $query = $this->db->query($sql . $limit);
        $ret['data'] = $query->result();
        $ret['jumlah'] = $this->db->query($sql)->num_rows();
        return $ret;
    }

    function relasi_shelter_delete_data($id){
        $this->db->where('id', $id)->delete('relasi_shelter');
    }

    function relasi_shelter_save_data(){

        $temp_jalur = json_decode(post_safe('koordinat_rute'));
        $id_shelter_awal = post_safe('id_shelter_awal');
        $id_shelter_tujuan = post_safe('id_shelter_tujuan');

        $koord = $this->get_shelter($id_shelter_awal);
        $koord_shelter_awal = array(
                                'd' => $koord->latitude,
                                'e' => $koord->longitude
                            );

        $koord = $this->get_shelter($id_shelter_tujuan);
        $koord_shelter_tujuan = array(
                                'd' => $koord->latitude,
                                'e' => $koord->longitude
                            );

        $jalur = array((Object)$koord_shelter_awal);
        foreach ($temp_jalur as $key => $value) {
            
            array_push($jalur, $value);
        }
        array_push($jalur, (Object)$koord_shelter_tujuan);


        $data = array(
            'id_shelter_awal' => $id_shelter_awal,
            'id_shelter_tujuan' => $id_shelter_tujuan,
            'jalur' => json_encode($jalur)
        );

        $id = post_safe('id');

        if ($id === '') {
            $this->db->insert('relasi_shelter', $data);
            $id = $this->db->insert_id();
        }else{
            $this->db->where('id', $id)->update('relasi_shelter', $data);
        }

        return $id;
    }

    function get_relasi_shelter($id){
        $sql = "select * from relasi_shelter
            where id = '".$id."'";
        return $this->db->query($sql)->row();
    }

    function get_relasi_shelter2($awal, $tujuan){
        $sql = "select * from relasi_shelter
            where id_shelter_awal = '".$awal."' 
            and id_shelter_tujuan = '".$tujuan."' ";
            //echo $sql;
        return $this->db->query($sql)->row();
    }

    function cek_relasi_shelter($shelter_awal, $shelter_tujuan){
        $sql = "select * from relasi_shelter
                where id_shelter_awal = '".$shelter_awal."'
                and id_shelter_tujuan = '".$shelter_tujuan."'";
        return $this->db->query($sql)->num_rows();
    }
    /* Relasi Shelter */

    function get_koordinat_rute($id_jalur){
        $sql = "select * from koordinat_rute
                where id_jalur = '".$id_jalur."' order by id";
        return $this->db->query($sql)->result();    
    }

    function get_koordinat_rute_with_limit($id_jalur, $awal, $batas){
        $q_awal = $this->db->where(array('id_jalur' => $id_jalur ,'id_shelter' => $awal))->get('koordinat_rute')->row();
        $q_akhir = $this->db->where(array('id_jalur' => $id_jalur ,'id_shelter' => $batas))->get('koordinat_rute')->row();
        $id_awal = '';
        $id_akhir = '';

        if(sizeof($q_awal) > 0){
            $id_awal = " and id >= '".$q_awal->id."' ";
        }

        if(sizeof($q_akhir) > 0){
            $id_akhir = "and id <= '".$q_akhir->id."'";
        }

        $sql = "select * from koordinat_rute
                where id_jalur = '".$id_jalur."' ";
        $order = " order by id";
        //echo $sql.$id_awal.$id_akhir.$order;
        $data =  $this->db->query($sql.$id_awal.$id_akhir.$order)->result();

        if (sizeof($data) < 1) {
            $data =  $this->db->query($sql.$id_awal.$order)->result();
            $merge = $this->db->query($sql.$id_akhir.$order)->result();
            $data = array_merge($data, $merge);
            //echo print_r($data);
        }

        return $data;
    }

    function museum_populer(){
        $sql = "select * from museum order by hit desc limit 0, 5";

        return $this->db->query($sql)->result();
    }

    function artikel_populer(){
        $sql = "select * from artikel order by hit desc limit 0, 5";

        return $this->db->query($sql)->result();
    }

    function get_visitor($awal){
        $sql = "
            select
            AllDaysYouWant.MyJoinDate,
            count( date(waktu) ) as jumlah
            from
            ( select
                    @curDate := Date_Add(@curDate, interval 1 day) as MyJoinDate
                 from
                    ( select @curDate := '$awal' ) sqlvars,
                    visitor_counter
                 limit 7 ) AllDaysYouWant
            LEFT JOIN visitor_counter p
               on AllDaysYouWant.MyJoinDate = date(p.waktu)
            group by
            AllDaysYouWant.MyJoinDate
        ";
        return $this->db->query($sql);
    }

}
