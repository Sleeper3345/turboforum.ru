<?php
class Profile extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->helper('url_helper');
    }

    public function index($login = FALSE)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($login !== FALSE) {
            $data['user_item'] = $this->profile_model->get_user($login);
        } else {
            if (isset($_SESSION['userid'])) {
                $data['user_item'] = $this->profile_model->get_user($_SESSION['login']);
            } else
                show_404();
        }
        $data['title'] = 'Профиль пользователя '.$data['user_item']['login'];

        $this->load->view('templates/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }
}