<?php

class Reset_model extends MY_Model
{
    // code lifetime 10 minutes
    const lifetime = 600;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('form_validation');

        // load config file with validation rules
        $this->config->load('config_validation');
    }

    public function checkEmail()
    {
        // get post data
        $request = $this->input->post(NULL, TRUE);

        //check fields in post request
        if (count($request) != 1 || !array_key_exists('email', $request))
        {
            throw new Exception("Unknown field in request");
        }

        //validate email
        if (!$this->validate($request, 'reset_post'))
        {
            return false;
        }

        //find user with email
        $this->db->where('username', $request['email']);
        $user = $this->db->get_where('users')->row_array();

        // if no such user found
        if ($user == NULL)
        {
               return NULL;
        }

        return $user;
    }

    public function makeCode($id)
    {
        // generate code
        $data['code'] = bin2hex($this->security->get_random_bytes(32));
        // set userid
        $data['userid'] = $id;
        // set lifetime of a code
        $data['lifetime'] = time() + self::lifetime;
        // send INSERT request to DB
        if (!$this->db->insert('reset', $data))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        return $data['code'];
    }

    public function checkCode()
    {
        // get field values
        $fields = $this->config->item('reset', 'table_fields');

        foreach ($fields as $field)
        {
            if ($this->input->input_stream($field) !== NULL)
            {
                $request[$field] = $this->input->input_stream($field);
            }
        }

        //validate password and code
        if (!$this->validate($request, 'reset_put'))
        {
            return false;
        }

        //check code
        $this->db->where('code', $request['code']);
        $code = $this->db->get_where('reset')->row_array();

        // if no such code exists
        if ($code == NULL)
        {
            return NULL;
        }

        // if lifetime expired or code has been already used
        if ($code['lifetime'] < time() || $code['used'] == 'yes')
        {
            throw new Exception('Code is expired!');
        }

        //find user
        $this->db->where('id', $code['userid']);
        $user = $this->db->get_where('users')->row_array();

        // if no such user found
        if ($user == NULL)
        {
            return NULL;
        }

        // send UPDATE request to DB
        if(!$this->db->update('users', array('password' => $request['password']), array('id' => $user['id'])))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        // mark code as used
        if(!$this->db->update('reset', array('used' => 'yes'), array('code' => $code['code'])))
        {
            throw new Exception('Internal Server Error. Please try again later');
        }

        return true;
    }
}
