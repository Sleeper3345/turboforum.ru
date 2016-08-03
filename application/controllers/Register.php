<?php
class Register extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Регистрация';

        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('register/index', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->register_model->add_user();
            $this->load->view('templates/header', $data);
            $this->load->view('register/success');
            $this->load->view('templates/footer');
        }
    }
}