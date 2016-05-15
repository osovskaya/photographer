<?php

class MY_Model extends CI_Model
{
    public $tableName = NULL;

    /*
     * read object
     * method GET
     * 
     * @param $id
     * @return null
     */
    public function get($id)
    {
        // if no id passed
        if ($id === NULL)
        {
            $query = $this->db->get($this->tableName)->result_array();
        }
        // if id passed
        else
        {
            $query = $this->db->get_where($this->tableName, array('id' => $id))->row_array();
        }

        // if no object found
        if ($query === NULL)
        {
            return NULL;
        }

        return $query;
    }

    /*
     * add new object
     * method POST
     * 
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function add($request)
    {
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

    /*
     * update object
     * method PUT
     *
     * @param $request
     * @param $object
     * @return bool
     * @throws Exception
     */
    public function update($request, $object)
    {
        // validate fields
        if (!$this->validate($request, $this->tableName.'_put'))
        {
            return false;
        }

        // send UPDATE request to DB
        if(!$this->db->update($this->tableName, $request, "id = {$object['id']}"))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }

    /*
     * delete object
     * method DELETE
     *
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        // send DELETE request to DB
        if(!$this->db->delete($this->tableName, array('id' => $id)))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }
        return true;
    }

    /**
     * validate fields
     *
     * @param $data
     * @param $rules
     * @return bool
     */
    public function validate($data, $rules)
    {
        // set data to be validated and validation rules
        $this->form_validation->reset_validation();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($this->config->item($rules));

        // validate fields
        if (!$this->form_validation->run())
        {
            return false;
        }

        return true;
    }
}
