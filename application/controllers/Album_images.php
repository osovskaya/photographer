<?php

class Album_images extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load users_model
        $this->load->model('album_images_model', 'object');
        $this->load->model('resized_model');
        
        // set tablename
        $this->tableName = 'album/images';
    }

    public function add()
    {
        // if no file loaded
        if (!isset($_FILES['file']))
        {
            $this->sendResponse(400);
        }

        // add new object
        $response = $this->object->add();

        // if request is successful return 201 code
        // and object with userid in json format
        if ($response === NULL) $this->sendResponse(404);
        elseif ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
        elseif ($response)
        {
            // save response in a cache
            if (!empty($response['id']))
            {
                $this->cache_model->addCache($this->tableName.$response['id'], $response, 86400);
            }
            else
            {
                $this->cache_model->addCache($this->tableName, $response, 86400);
            }

            // send request to resize new image
            $this->requestResizeAdd(array('photo_id' => $response['id'], 'size' => 100));
            $this->requestResizeAdd(array('photo_id' => $response['id'], 'size' => 400));

            $this->sendResponse(201, $response);
        }
    }

    public function requestResizeAdd($data)
    {
        $data_string = http_build_query($data);

        $curl = curl_init($this->config->item('base_url').'resized');

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($data_string))
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        // Send the request
        curl_exec($curl);

        // Free up the resources $curl is using
        curl_close($curl);
    }
}
