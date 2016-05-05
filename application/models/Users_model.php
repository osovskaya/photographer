<?php

require_once ('Main_model.php');

class Users_model extends Main_model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('form_validation');

        // load config file with validation rules
        $this->config->load('config_validation');

        // set tablename
        $this->tableName = 'users';
    }
}
