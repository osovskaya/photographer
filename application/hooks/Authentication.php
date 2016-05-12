<?php

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('cookie');
        $this->load->database();
    }

    public function authenticate()
    {
        //$this->logout();
        // for all requests except request to add new user
        // and requests to resize image
        if ($this->input->method() == 'post' && $this->uri->segment(1) == 'users')
        {
            return true;
        }

        if ($this->uri->segment(1) == 'resized')
        {
            return true;
        }

        // get token from cookie
        $token = $this->input->cookie('access_token', TRUE);
        if ($token === NULL)
        {
           // get user by authorization header
            $user = $this->getUserByHeader();
        }
        else
        {
            // get user by token
            $user = $this->getUserByToken($token);
            // check username
            if ($user['username'] != $this->input->server('PHP_AUTH_USER'))
            {
                // get user by token
                $this->sendResponse(401);
                exit();
            }
        }

        // authorize user by password
        if ($user['password'] != $this->input->server('PHP_AUTH_PW'))
        {
            header('WWW-Authenticate: Basic realm="REST API"');
            $this->output->set_header('HTTP/1.1 401 Unauthorized');
            exit();
        }
    }

    /**
     *  Get user data by token
     */
    public function getUserByToken($token)
    {
        // get user by token
        $user = $this->db->get_where('users', array('token' => $token))->row_array();
        // if token not found, send response 401
        if ($user === NULL)
        {
            // clear cookie
            unset($_COOKIE["access_token"]);
            header('WWW-Authenticate: Basic realm="REST API"');
            $this->output->set_header('HTTP/1.1 401 Unauthorized');
            exit();
        }

        return $user;
    }

    /**
     *  Get user data by Authorization header
     */
    public function getUserByHeader()
    {
        // get user from header
        $username = $this->input->server('PHP_AUTH_USER');
        // if username empty return 401 code and ask to log in
        if ($username === NULL)
        {
            $this->sendResponse(401);
            exit();
        }
        // get user by username
        $user = $this->db->get_where('users', array('username' => $username))->row_array();
        // if no user found return 404 code
        if ($user === NULL)
        {
            $this->sendResponse(404);
            exit();
        }
        else
        {
            $this->generateToken($username);
            return $user;
        }
    }

    /**
     * Generate token and save it in users table and in cookies
     */
    public function generateToken($username)
    {
        $token = bin2hex($this->security->get_random_bytes(32));

        $data = array('token' => $token);
        $this->db->where('username', $username);
        $this->db->update('users', $data);

        $this->input->set_cookie('access_token', $token, 86400,'','','','',TRUE);
        return true;
    }



    public function logout()
    {
        // unset cookies
        unset($_COOKIE);

        //unset authorization header
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
    }
}
