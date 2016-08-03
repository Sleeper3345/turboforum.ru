<?php
class MY_Controller extends CI_Controller {

public function __construct()
{
    parent::__construct();
    session_set_cookie_params ( 86400, '/' );
    if (!isset($_SESSION)) {
        //ini_set('session.use_trans_sid', 0);
        session_start();
    }
}

}