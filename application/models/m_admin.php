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

    function user_get_data($limit, $start, $search){
        $q = '';
        if (isset($search['id']) && ($search['id'] !== '')) {
            $q .= " and id = '".$search['id']."'";
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
    
}
