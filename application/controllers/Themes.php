<?php
class Themes extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('themes_model');
        $this->load->helper('url_helper');
    }

    public function index($theme = NULL)
    {
        if ($theme != NULL) {
            $data['theme'] = $theme;
            $data['theme_name'] = $this->themes_model->get_category($theme);
            $data['title'] = 'Темы из категории "'.$data['theme_name']['name'].'"';
            $data['themes'] = $this->themes_model->get_themes($theme);
            $data['authors'] = $this->themes_model->get_authors($theme);
            $data['dates'] = $this->themes_model->get_dates($theme);
        }
        else
            show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('themes/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        parse_str($_SERVER['QUERY_STRING'], $_GET);

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        $headerdata['title'] = "Добавить тему";

        $data['categories'] = $this->themes_model->get_categories();

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $headerdata);
            $this->load->view('themes/add', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $datatitle['title'] = $this->input->post('title');
            $this->themes_model->add_theme();
            $data['theme'] = $this->themes_model->find_theme($datatitle['title']);
            $this->load->view('templates/header', $datatitle);
            $this->load->view('action/add_theme', $data);
            $this->load->view('templates/footer');
        }
    }

    public function post($id = NULL)
    {
        if ($id === NULL)
            show_404();
        else {

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (isset($_SESSION['userid']))
                $this->form_validation->set_rules('text', 'text', 'required');

            $data['post'] = $this->themes_model->get_theme($id);
            $data['comments'] = $this->themes_model->get_comments($id);
            $data['date'] = $this->themes_model->get_date($id);
            $data['author'] = $this->themes_model->get_author($id);
            $data['com_dates'] = $this->themes_model->get_comments_dates($id);
            $data['com_authors'] = $this->themes_model->get_comments_authors($id);
            $headerdata['title'] = $data['post']['title'];
        }

        $this->load->view('templates/header', $headerdata);
        $this->load->view('themes/post', $data);
        $this->load->view('templates/footer');
    }
}