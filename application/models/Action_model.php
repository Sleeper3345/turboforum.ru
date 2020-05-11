<?php
class Action_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function add_comment($theme_id = NULL)
    {
        $text = $this->input->post('text');

        $data = array(
            'author' => $_SESSION['userid'],
            'date' => date("y-m-d H:i"),
            'text' => $text,
            'theme' => $theme_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'port' => $_SERVER['REMOTE_PORT'],
        );

        $this->db->insert('comment', $data);
    }

    public function check_pass($nick, $pass)
    {
        $query = $this->db->get_where('user', array('login' => $nick))->row_array();

        if ($query['password'] == $pass)
            return 'true';
        else
            return 'false';
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('user', array('id' => $id))->row_array();
        return $query;
    }

    public function add_mess($message, $from, $to)
    {
        $to_id = $this->db->get_where('user', array('login' => $to))->row_array();

        $data = array(
            'data' => date("y-m-d H:i"),
            'text' => $message,
            'fromuser' => $from,
            'touser' => $to_id['id']
        );

        $this->db->insert('message', $data);
    }

    public function add_comm_minus($comm, $user)
    {
        $query = $this->db->get_where('comment_minus', array('comment_id' => $comm, 'user_id' => $user))->row_array();
        if (!isset($query)) {
            $query2 = $this->db->get_where('comment', array('id' => $comm))->row_array();
            $data1 = array(
                'rating' => $query2['rating'] - 1
            );
            $query3 = $this->db->get_where('comment_plus', array('comment_id' => $comm, 'user_id' => $user))->row_array();

            $this->db->where('comment_id', $comm);
            $this->db->where('user_id', $_SESSION['userid']);
            $this->db->delete('comment_plus');

            if (!isset($query3)) {
                $data = array(
                    'comment_id' => $comm,
                    'user_id' => $user
                );
                $this->db->insert('comment_minus', $data);
            }

            $this->db->where('id', $comm);
            $this->db->update('comment', $data1);
            return 'true';
        }
        return 'false';
    }

    public function add_comm_plus($comm, $user)
    {
        $query = $this->db->get_where('comment_plus', array('comment_id' => $comm, 'user_id' => $user))->row_array();
        if (!isset($query)) {
            $query2 = $this->db->get_where('comment', array('id' => $comm))->row_array();
            $data1 = array(
                'rating' => $query2['rating'] + 1
            );
            $query3 = $this->db->get_where('comment_minus', array('comment_id' => $comm, 'user_id' => $user))->row_array();

            $this->db->where('comment_id', $comm);
            $this->db->where('user_id', $_SESSION['userid']);
            $this->db->delete('comment_minus');

            if (!isset($query3)) {
                $data = array(
                    'comment_id' => $comm,
                    'user_id' => $user
                );
                $this->db->insert('comment_plus', $data);
            }

            $this->db->where('id', $comm);
            $this->db->update('comment', $data1);
            return 'true';
        }
        return 'false';
    }

    public function check_user_nick($nick)
    {
        $query = $this->db->get_where('user', array('login' => $nick))->row_array();
        if (isset($query)) {
            $result = 'false';
        } else {
            $result = 'true';
        }
        return $result;
    }
}