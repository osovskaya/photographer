<?php

require_once ('Main.php');

class ALbums extends Main
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
