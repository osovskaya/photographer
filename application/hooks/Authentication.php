<?php

class Authentication extends CI_Controller
{
    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->database();
    }

    /**
     * @apiGroup authentication
     *
     * @api {put} /object_name/:id user authorization
     *
     * @apiName authenticate
     *
     * @apiHeader {String} Authorization Bearer token or Basic username:password
     *
     * @apiHeaderExample {String} Header-Example:
     *     "Authorization: Bearer 123456789"
     *
     *  @apiHeaderExample {String} Header-Example:
     *     "Authorization: Basic test:test"
     *
     * @apiSuccess (Success 200) 200 OK
     *
     * @apiError 401 Unauthorized
     *
     *@apiDescription user authorization
     */
    public function authenticate()
    {
        // for all requests except request to add new user
        // and requests to resize image
        if ($this->input->method() == 'post' && $this->uri->segment(1) == 'users')
        {
            return true;
        }

        // get authorization header
        $headers = getallheaders();

        if (!isset($headers['Authorization']))
        {
            //ask to login
            header('WWW-Authenticate: Basic realm="REST API"');
            $this->output->set_header('HTTP/1.1 401 Unauthorized');
            exit();
        }

        $authMethod = substr($headers['Authorization'], 0, 6);

        if ($authMethod == 'Bearer')
        {
            // authorize user by token
            $token = substr($headers['Authorization'], 7);
            $this->getUserByToken($token);
            return;
        }
        else
        {
            // get user by username and password
            $user = $this->getUserByHeader();

            // authorize user by password
            if ($user['password'] != $this->input->server('PHP_AUTH_PW'))
            {
                header('WWW-Authenticate: Basic realm="REST API"');
                $this->output->set_header('HTTP/1.1 401 Unauthorized');
                exit();
            }
        }
    }

    /**
     * @param $token
     * @return bool
     */
    public function getUserByToken($token)
    {
        // get user by token
        $user = $this->db->get_where('users', array('token' => $token))->row_array();
        // if token not found, send response 401
        if ($user === NULL)
        {
            header('WWW-Authenticate: Basic realm="REST API"');
            $this->output->set_header('HTTP/1.1 401 Unauthorized');
            exit();
        }

        return true;
    }

    /**
     * @return mixed
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
     * @param $username
     * @return bool
     */
    public function generateToken($username)
    {
        $token = bin2hex($this->security->get_random_bytes(32));

        $data = array('token' => $token);
        $this->db->where('username', $username);
        $this->db->update('users', $data);

        header("Authorization: Bearer $token");
        $this->output->set_header("Authorization: Bearer $token");
        return true;
    }
}
