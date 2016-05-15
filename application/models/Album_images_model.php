<?php

class Album_images_model extends MY_Model
{
    /**
     * Album_images_model constructor.
     *
     * @property integer $id
     * @property integer $album
     * @property string $name
     * @property string $image
     * @property string $type
     */
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

            if ($query === NULL)
            {
                return NULL;
            }

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
            if ($query === NULL)
            {
                return NULL;
            }

            //encode response
            $query['image'] = base64_encode(addslashes($query['image']));
            $query['image'] = 'data:'.$query['type'].';base64,'.$query['image'];
        }

        return $query;
    }

    /*
     * add new image
     * method POST
     * 
     * @param $request
     * @return bool|null
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

        if (!file_exists($_FILES['file']['tmp_name']))
        {
            return false;
        }

        if ($_FILES['file']['type'] != 'image/jpeg' || $_FILES['file']['type'] != 'image/png')
        {
            return false;
        }

        // read the uploaded image
        $request['image'] = file_get_contents($_FILES['file']['tmp_name']);
        // get the uploaded file type
        $request['type'] = $_FILES['file']['type'];

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

    /**
     * @param $request
     * @param $object
     * @return bool|null
     * @throws Exception
     */
    public function update($request, $object)
    {
        if (isset($request['album']))
        {
            // check that album with id = album exists
            if (!$this->db->get_where('albums', array('id' => $object['album'])))
            {
                return NULL;
            }
        }
        
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
}
