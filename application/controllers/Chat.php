<?php
class Chat extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('action_model');
        $this->load->model('chat_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if (!isset($_SESSION['userid']))
            show_404();

        $me = $_SESSION['login'];
        $to = $_GET['to'];
        $data['status'] = $this->chat_model->try_exist_or_ban($me, $to);
        if ($data['status'] == 'true') {
            $data['messages'] = $this->chat_model->get_messages($me, $to);
            foreach ($data['messages'] as $key => $value) {
                $data['users'][$key] = $this->action_model->get_user_by_id($value['fromuser']);
            }
            $data['title'] = "Чат - " . $_GET['to'];
        } else {
            $data['title'] = "Чат";
        }
            $this->load->view('templates/header', $data);
            $this->load->view('chat/index', $data);
            $this->load->view('templates/footer');

    }
}