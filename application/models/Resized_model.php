<?php

class Resized_model extends MY_Model
{
    /**
     * Resized_model constructor.
     *
     * @property integer $id
     * @property string $size
     * @property integer $photo_id
     * @property string $src
     * @property string $status
     * @property string $comment
     */
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

    /**
     * @param $id
     * @return null
     */
    public function get($id)
    {
        // if no id passed
        if ($id === NULL)
        {
            return NULL;
        }
        // if id passed
        else
        {
            // get completed resized photos for photo_id
            $query = $this->db->get_where($this->tableName, array('photo_id' => $id, 'status' => 3))->result_array();
        }

       // if no object found
        if ($query === NULL)
        {
            return NULL;
        }

        return $query;
    }
}
