<?php

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load users_model
        $this->load->model('users_model', 'object');
        
        // set tablename
        $this->tableName = 'users';
    }
}
