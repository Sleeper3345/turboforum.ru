<?php
class Auth extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Авторизация';

        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            header('Location: /');
            $this->auth_model->auth();
        }
    }

    public function logout()
    {
        header('Location: /');
        $this->auth_model->logout();
        $this->load->view('templates/header');
        $this->load->view('action/logout');
        $this->load->view('templates/footer');
    }
}