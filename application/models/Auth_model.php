<?php
class Auth_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function auth()
    {
        $this->load->library('session');

        $username = $this->input->post('login');
        $password = $this->input->post('password');

        $query1 = $this->db->get_where('user', array('login' => $username));
        $query = $query1->row();

            if ($query->password == $password)
            {
                $newdata = array(
                    'userid' => $query->id,
                    'login'  => $username,
                    'type'     => $query->type,
                    'rang' => $query->rang,
                    'rating' => $query->rating
                );
                $this->session->set_userdata($newdata);
            }
    }

    public function logout()
    {
        $this->load->library('session');
        session_destroy();
    }
}