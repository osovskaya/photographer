<?php

class Albums extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load albums_model
        $this->load->model('albums_model', 'object');

        // set tablename
        $this->tableName = 'albums';
    }
}
