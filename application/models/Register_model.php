<?php
class Register_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function add_user()
    {
        $pass = $this->input->post('password');


        $data = array(
            'login' => $this->input->post('login'),
            'password' => $pass,
            'rang' => 'child',
            'type' => 'just_user'
        );

        return $this->db->insert('user', $data);
    }
}