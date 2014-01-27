<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {
     function cek_login() {
        $sql = "select * from users u
        where u.username = '".post_safe('username')."' and u.password = '".md5(post_safe('password'))."'";
        //echo $query;
        $hasil=$this->db->query($sql);
        return $hasil->row();
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
            'username' => post_safe('user'),
            'password' => md5('1234')
        );

        $id = post_safe('id');

        if ($id === '') {
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
            'isi' => post_safe('isi_artikel')            
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
        $sql = "select a.*, u.username, m.nama as museum from artikel a
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
            'longitude' => post_safe('longitude'),
            'latitude' => post_safe('latitude'),
            'keterangan' => post_safe('keterangan_museum')            
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
    
}
