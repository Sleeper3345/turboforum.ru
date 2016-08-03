<?php
class Action extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('action_model');
        $this->load->model('chat_model');
        $this->load->model('themes_model');
        $this->load->helper('url_helper');
    }

    public function add_comment($theme_id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($theme_id === NULL || !isset($_SESSION['userid']))
            show_404();
        else {

            $this->form_validation->set_rules('text', 'text', 'required');

            $data['post_id'] = $theme_id;

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('action/add_comment', $data);
                $this->load->view('templates/footer');

            } else {
                $this->action_model->add_comment($theme_id);
                $this->load->view('templates/header');
                $this->load->view('action/add_comment', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function check_password()
    {
        $nick = $this->input->post('nick');
        $pass = $this->input->post('pass');
        $data['result'] = $this->action_model->check_pass($nick, $pass);
        $this->load->view('action/check_password', $data);
    }

    public function send_message()
    {
        $message = $this->input->post('message');
        $to = $this->input->post('to');
        $from = $_SESSION['userid'];

        $this->action_model->add_mess($message, $from, $to);
    }

    public function get_last_messages()
    {
        $to = $this->input->post('to');
        $me = $_SESSION['login'];
        $last_id = $this->input->post('last_id');
        $result = $this->chat_model->get_last_messages($me, $to, $last_id);
        if (isset($result))
            echo json_encode($result);
        else
            echo json_encode("no");
    }

    public function add_comment_minus()
    {
        $comment = $this->input->post('comment_id');
        $user = $this->input->post('user_id');
        $result = $this->action_model->add_comm_minus($comment, $user);
        echo json_encode($result);
    }

    public function add_comment_plus()
    {
        $comment = $this->input->post('comment_id');
        $user = $this->input->post('user_id');
        $result = $this->action_model->add_comm_plus($comment, $user);
        echo json_encode($result);
    }

    public function check_user_nick()
    {
        $nick = $this->input->post('nick');
        $result = $this->action_model->check_user_nick($nick);
        echo json_encode($result);
    }
}