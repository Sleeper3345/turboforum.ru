<?php
class Profile_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($login = FALSE)
    {
        $query = $this->db->get_where('user', array('login' => $login));
        return $query->row_array();
    }
}