<?php
class Pages extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pages_model');
        $this->load->helper('url_helper');
    }

    public function view($page = 'home')
    {
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = "Турбофорум";

        $data['categories'] = $this->pages_model->get_categories();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}