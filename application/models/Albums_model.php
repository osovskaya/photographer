<?php

require_once ('Main_model.php');

class Albums_model extends Main_model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('form_validation');

        // load config file with validation rules
        $this->config->load('config_validation');

        // set tablename
        $this->tableName = 'albums';
    }

    /*
     * add new album
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

        // validate fields
        if (!$this->validate($request, $this->tableName.'_post'))
        {
            return false;
        }

        // check that photographer with id = user exists
        if (!$this->findUser($request['user'], 2, 'users'))
        {
            return NULL;
        }

        // send INSERT request to DB
        if (!$this->db->insert($this->tableName, $request))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        // get id of the last inserted album
        $addedAlbumId = $this->db->insert_id();
         // get the last inserted album by id
        return $this->db->get_where($this->tableName, array('id' => $addedAlbumId))->row_array();
    }

    /*
     * update album
     * method PUT
    */
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

        if ($data['user'] !== NULL)
        {
            // check that photographer with id = user exists
            if (!$this->findUser($data['user'], 2, 'users'))
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


