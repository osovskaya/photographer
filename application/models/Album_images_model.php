<?php

class Album_images_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('form_validation');

        // load config file with validation rules
        $this->config->load('config_validation');

        // set tablename
        $this->tableName = 'album/images';
    }

    /*
     * read object
     * method GET
    */
    public function get($id)
    {
        // if no id passed
        if ($id === NULL)
        {
            $query = $this->db->get($this->tableName)->result_array();

            foreach ($query as $key => $value)
            {
                $query[$key]['image'] = base64_encode(addslashes($query[$key]['image']));
                $query[$key]['image'] = 'data:'.$query[$key]['type'].';base64,'.$query[$key]['image'];
            }
        }
        // if id passed
        else
        {
            $query = $this->db->get_where($this->tableName, array('id' => $id))->row_array();
            //encode response
            $query['image'] = base64_encode(addslashes($query['image']));
            $query['image'] = 'data:'.$query['type'].';base64,'.$query['image'];
        }

        // if no object found
        if ($query === NULL)
        {
            return NULL;
        }

        return $query;
    }

    /*
     * add new image
     * method POST
    */
    public function add()
    {
        // get POST fields with XSS filtering
        $request = $this->input->post(NULL, TRUE);

        // check fields in post request
        foreach ($request as $field => $value)
        {
            // if field unknown throw exception, return 406 code
            if (!in_array($field, $this->config->item($this->tableName, 'table_fields')))
            {
                throw new Exception("Unknown field '$field'");
            }
        }

        if (!file_exists($_FILES['file']['tmp_name']))
        {
            return false;
        }
        // read the uploaded image
        $request['image'] = file_get_contents($_FILES['file']['tmp_name']);
        // get the uploaded file type
        $request['type'] = $_FILES['file']['type'];

        // check that image type is jpg or png
        if ($request['type'] != 'image/jpeg' || $request['type'] != 'image/png')
        {
            return false;
        }

        // validate fields
        if (!$this->validate($request, $this->tableName.'_post'))
        {
            return false;
        }

        // check that album with id = album_id exists
        if (!$this->db->get_where('albums', array('id' => $request['album']))->row_array())
        {
            return NULL;
        }

        // send INSERT request to DB
        if (!$this->db->insert($this->tableName, $request))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        // get id of the last inserted image
        $addedImageId = $this->db->insert_id();

        // get the last inserted photo by id
        $image = $this->db->get_where($this->tableName, array('id' => $addedImageId))->row_array();
        $imageEncoded = base64_encode(addslashes($image['image']));
        $image['image'] = 'data:'.$image['type'].';base64,'.$imageEncoded;
        return $image;
    }

    public function update($id)
    {
        // check if album with id exists
        if ($this->db->get_where($this->tableName, array('id' => $id))->row_array() === NULL)
        {
            return NULL;
        }

        // get field value
        $fields = $this->config->item($this->tableName, 'table_fields');

        foreach ($fields as $field)
        {
            if ($this->input->input_stream($field) !== NULL)
            {
                $data[$field] = $this->input->input_stream($field);
            }
        }

        if ($data['album'] !== NULL)
        {
            // check that album with id = album exists
            if (!$this->findUser($data['album'], false, 'albums'))
            {
                return NULL;
            }
        }

        // validate fields
        if (!$this->validate($data, $this->tableName.'_put'))
        {
            return false;
        }

        // send UPDATE request to DB
        if(!$this->db->update($this->tableName, $data, "id = $id"))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }
}
