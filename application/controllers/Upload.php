<?php

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('upload_form', array('error' => ' ' ));
    }

    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';
        $config['file_ext_tolower']     = TRUE;
        $config['max_size']             = 4194304;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
           return array('error' => $this->upload->display_errors());
           //var_dump(array('error' => $this->upload->display_errors()));
        }
        else
        {
            var_dump(array('upload_data' => $this->upload->data()));
            return array('upload_data' => $this->upload->data());
        }
    }
}
