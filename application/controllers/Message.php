<?php
class Message extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->view('message/index');
    }

    public function write($login = FALSE)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['user_item'] = $this->message_model->get_user($login);
        $data['title'] = 'Сообщения пользователя '.$data['user_item']['login'];

        $this->load->view('templates/header');
        $this->load->view('message/write.php', $data);
        $this->load->view('templates/footer');
    }

    public function send()
    {
        $this->load->view('message/send.php');
    }
}