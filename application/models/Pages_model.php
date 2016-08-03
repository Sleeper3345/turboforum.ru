<?php
class Pages_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories()
    {
        $query = $this->db->get('category');
        return $query->result_array();
    }

}