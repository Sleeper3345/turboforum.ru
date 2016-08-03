<?php
class Message_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($login = FALSE)
    {
        $this->load->library('session');

        if ($login === FALSE)
        {
            if (isset($_SESSION['userid'])) {
                $query = $this->db->get_where('user', array('login' => $_SESSION['login']));
                return $query->row_array();
            }
            else
                show_404();
        }

        $query = $this->db->get_where('user', array('login' => $login));
        return $query->row_array();
    }

}