<?php

class Albums_model extends MY_Model
{
    /**
     * Albums_model constructor.
     *
     * @property integer $id
     * @property integer $user
     * @property string $name
     */
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
    public function add($request)
    {
        // check fields in post request
        foreach ($request as $field => $value)
        {
            // if field unknown throw exception
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
        if (!$this->db->get_where('users', array('id' => $request['user'], 'role' => 2))->row_array())
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
    public function update($request, $object)
    {
        foreach ($request as $field)
        {
            if ($this->input->input_stream($field) !== NULL)
            {
                $data[$field] = $this->input->input_stream($field);
            }
        }

        if ($data['user'] !== NULL)
        {
            // check that photographer with id = user exists
            if (!$this->db->get_where('users', array('id' => $object['user'], 'role' => 2))->row_array())
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
        if(!$this->db->update($this->tableName, $data, "id = {$object['id']}"))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }
}


