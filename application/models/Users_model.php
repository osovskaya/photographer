<?php

class Users_model extends MY_Model
{
    /**
     * Users_model constructor.
     *
     * @property integer $id
     * @property string $role
     * @property string $name
     * @property string $username
     * @property string $password
     * @property string $phone
     */
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
