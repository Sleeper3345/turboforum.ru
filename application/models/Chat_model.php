<?php
class Chat_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_messages($me, $to)
    {
        $me_id = $this->db->get_where('user', array('login' => $me))->row_array();
        $to_id = $this->db->get_where('user', array('login' => $to))->row_array();
        $query = $this->db->get_where('message', array('fromuser' => $me_id['id'], 'touser' => $to_id['id']))->result_array();
        $q = array_merge($query, $this->db->get_where('message', array('touser' => $me_id['id'], 'fromuser' => $to_id['id']))->result_array());

        function cmp($a, $b)
        {
            if ($a["id"] < $b["id"])
                return -1;
            else
                return 1;
        }

        usort($q, "cmp");

        return $q;
    }

    public function get_last_messages($me, $to, $last_id)
    {
        $me_id = $this->db->get_where('user', array('login' => $me))->row_array();
        $to_id = $this->db->get_where('user', array('login' => $to))->row_array();
        $query = $this->db->get_where('message', array('fromuser' => $me_id['id'], 'touser' => $to_id['id']))->result_array();
        $q = array_merge($query, $this->db->get_where('message', array('touser' => $me_id['id'], 'fromuser' => $to_id['id']))->result_array());

        foreach ($q as $key => $value)
        {
            if ($value['fromuser'] == $me_id['id'])
                $q[$key]['user_nick'] = $me;
            else
                $q[$key]['user_nick'] = $to;
        }


        function cmp($a, $b)
        {
            if ($a["id"] < $b["id"])
                return -1;
            else
                return 1;
        }

        usort($q, "cmp");

        foreach ($q as $key => $value)
        {
            if ($value['id'] <= $last_id)
                unset($q[$key]);
        }

        return $q;
    }

    public function try_exist_or_ban($me, $to)
    {
        $me_id = $this->db->get_where('user', array('login' => $me))->row();
        $to_id = $this->db->get_where('user', array('login' => $to))->row();
        if (isset($to_id)) {
            return 'true';
        } else {
            return 'false';
        }
    }

}