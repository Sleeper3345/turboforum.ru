<?php
class Users extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('users/index.php');
        $this->load->view('templates/footer');
    }

    public function show()
    {
        $this->load->view('users/show.php');
    }
}