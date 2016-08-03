<?php
class Themes_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_themes($theme = NULL)
    {
        $query = $this->db->get_where('category', array('name_url' => $theme))->row_array();
        $query2 = $this->db->get_where('theme', array('category_id' => $query['id']));

        return $query2->result_array();
    }

    public function get_authors($theme = NULL)
    {
        $query = $this->db->get_where('category', array('name_url' => $theme))->row_array();
        $query2 = $this->db->get_where('theme', array('category_id' => $query['id']))->result_array();
        if (count($query2) > 0)
        {
            foreach ($query2 as $key => $value) {
                $authors[$key] = $this->db->get_where('user', array('id' => $value['author']))->row_array();
            }
            return $authors;
        }
        return null;
    }

    public function get_author($id = NULL)
    {
        $query = $this->db->get_where('theme', array('id' => $id))->row_array();
        $author = $this->db->get_where('user', array('id' => $query['author']))->row_array();

        return $author;
    }

    public function get_comments_authors($id = NULL)
    {
        $query = $this->db->get_where('comment', array('theme' => $id))->result_array();
        if (count($query) > 0)
        {
            foreach ($query as $key => $value) {
                $authors[$key] = $this->db->get_where('user', array('id' => $value['author']))->row_array();
            }
            return $authors;
        }
        return null;
    }

    public function get_comments_dates($id = NULL)
    {
        $query = $this->db->get_where('comment', array('theme' => $id))->result_array();
        if (count($query) > 0)
        {
            foreach ($query as $key => $value) {
                $date_time_string = $value['date'];

                $dt_elements = explode(' ', $date_time_string);

                $date_elements = explode('-', $dt_elements[0]);

                $time_elements = explode(':', $dt_elements[1]);

                $dates[$key] = "$date_elements[2].$date_elements[1].$date_elements[0] $time_elements[0]:$time_elements[1]";
            }
            return $dates;
        }
        return null;
    }

    public function get_dates($theme = NULL)
    {
        $query = $this->db->get_where('category', array('name_url' => $theme))->row_array();
        $query2 = $this->db->get_where('theme', array('category_id' => $query['id']))->result_array();
        if (count($query2) > 0)
        {
            foreach ($query2 as $key => $value) {
                $date_time_string = $value['time'];

                $dt_elements = explode(' ', $date_time_string);

                $date_elements = explode('-', $dt_elements[0]);

                $time_elements = explode(':', $dt_elements[1]);

                $dates[$key] = "$date_elements[2].$date_elements[1].$date_elements[0] $time_elements[0]:$time_elements[1]";
            }
            return $dates;
        }
        return null;
    }

    public function get_date($id = NULL)
    {
        $query = $this->db->get_where('theme', array('id' => $id))->row_array();
            $date_time_string = $query['time'];

            $dt_elements = explode(' ',$date_time_string);

            $date_elements = explode('-',$dt_elements[0]);

            $time_elements =  explode(':',$dt_elements[1]);

            $date = "$date_elements[2].$date_elements[1].$date_elements[0] $time_elements[0]:$time_elements[1]";

        return $date;
    }

    public function add_theme()
    {
        $title = $this->input->post('title');
        $text = $this->input->post('text');
        $category = $this->input->post('category');

        $query = $this->db->get_where('category', array('name_url' => $category))->row_array();
        $data = array(
            'count' => $query['count'] + 1
        );
        $this->db->where('name_url', $category);
        $this->db->update('category', $data);

        $data2 = array(
            'author' => $_SESSION['userid'],
            'time' => date("y-m-d H:i"),
            'title' => $title,
            'text' => $text,
            'category_id' => $query['id']
        );

        return $this->db->insert('theme', $data2);
    }

    public function get_theme($id = NULL)
    {
        $query = $this->db->get_where('theme', array('id' => $id))->row_array();

        return $query;
    }

    public function get_comments($id = NULL)
    {
        $query = $this->db->get_where('comment', array('theme' => $id))->result_array();

        return $query;
    }

    public function find_theme($title = NULL)
    {
        $query = $this->db->get_where('theme', array('title' => $title))->result_array();

        return array_pop($query);
    }

    public function get_categories()
    {
        $query = $this->db->get('category')->result_array();
        return $query;
    }

    public function get_category($name = NULL)
    {
        $query = $this->db->get_where('category', array('name_url' => $name))->row_array();

        return $query;
    }
}