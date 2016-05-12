<?php

class Resized_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('form_validation');

        // load config file with validation rules
        $this->config->load('config_validation');

        // set tablename
        $this->tableName = 'resized';
    }

    public function get($id)
    {
        // if no id passed
        if ($id === NULL)
        {
            if ($this->input->get('status') === '1')
            {
                // get the last added photo with new status
                $this->db-> order_by('photo_id', $direction = 'ASC');
                $query = $this->db->get_where($this->tableName, array('status' => 1))->row_array();
            }
            else
            {
                // get all photos
                $query = $this->db->get_where($this->tableName)->result_array();
            }
        }
        // if id passed
        else
        {
            if ($this->input->get('status') === '3')
            {
                // get completed resized photos to photo_id
                $query = $this->db->get_where($this->tableName, array('photo_id' => $id, 'status' => 3))->result_array();
            }
            else
            {
                // get all resized photos to photo_id
                $query = $this->db->get_where($this->tableName, array('photo_id' => $id))->result_array();
            }
        }

       // if no object found
        if ($query === NULL)
        {
            return NULL;
        }

        return $query;
    }

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

        // check that photo exists
        if (!$this->db->get_where('album/images', array('id' => $request['photo_id']))->row_array())
        {
            return NULL;
        }

        // validate fields
        if (!$this->validate($request, $this->tableName.'_post'))
        {
            return false;
        }

        // send INSERT request to DB
        if (!$this->db->insert($this->tableName, $request))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        // get id of the last inserted object
        $addedId = $this->db->insert_id();
        // get the last inserted object by id
        return $this->db->get_where($this->tableName, array('id' => $addedId))->row_array();
    }

    public function update($id)
    {
        // get field values
        $fields = $this->config->item($this->tableName, 'table_fields');

        foreach ($fields as $field)
        {
            if ($this->input->input_stream($field) !== NULL)
            {
                $data[$field] = $this->input->input_stream($field);
            }
        }

        // validate fields
        if (!$this->validate($data, $this->tableName.'_put'))
        {
            return false;
        }

        // check that photo exists in resized
        if (!$this->db->get_where('resized', array('photo_id' => $id, 'size' => $data['size']))->row_array())
        {
            return NULL;
        }

        // check that photo exists in album/images
        if (!$this->db->get_where('album/images', array('id' => $id))->row_array())
        {
            return NULL;
        }

        // send UPDATE request to DB
        if(!$this->db->update($this->tableName, $data, array('photo_id' => $id, 'size' => $data['size'])))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }

    public function delete($id)
    {
        // check if object with id exists
        if ($this->db->get_where($this->tableName, array('photo_id' => $id))->row_array() === NULL)
        {
            return NULL;
        }

        // send DELETE request to DB
        if(!$this->db->delete($this->tableName, array('photo_id' => $id)))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }
}
