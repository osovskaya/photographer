<?php

class MY_Controller extends CI_Controller
{
    public $tableName = NULL;

	/**
	 * MY_Controller constructor.
     */
	public function __construct()
	{
		parent::__construct();

		// load cache_model
		$this->load->model('cache_model');
	}

	/**
	 * @param null $id
     */
	public function get($id = NULL)
	{
		$response = $this->object->get($id);

		// if request is successful return 200 code and object in json format
		// else return 404 code
		if ($response === NULL) $this->sendResponse(404);
		elseif ($response)
		{
			// save response in a cache
			if (!empty($response['id']))
			{
				$this->cache_model->addCache($this->tableName.$response['id'], $response, 86400);
			}
			else
			{
				$this->cache_model->addCache($this->tableName, $response, 86400);
			}

			$this->sendResponse(200, $response);
		}
	}

	/**
	 * add new object
     */
	public function add()
	{
		//if post body empty, return code 400
		if (!$this->input->raw_input_stream)
		{
			$this->sendResponse(400);
			exit();
		}

		// get POST fields with XSS filtering
		$request = $this->input->post(NULL, TRUE);

		// add new object
		$response = $this->object->add($request);

		// if request is successful return 201 code
		// and object with userid in json format
		if ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
		elseif ($response)
		{
			// save response in a cache
			if (!empty($response['id']))
			{
				$this->cache_model->addCache($this->tableName.$response['id'], $response, 86400);
			}
			else
			{
				$this->cache_model->addCache($this->tableName, $response, 86400);
			}

			$this->sendResponse(201, $response);
		}
	}

	/**
	 * @param $id
     */
	public function update($id)
	{
		// check if object with id exists
		$object = $this->object->get($id);

		if($object == null)
		{
			$this->sendResponse(404);
			exit();
		}

		// if put body empty
		if (!$this->input->raw_input_stream)
		{
			$this->sendResponse(400);
			exit();
		}

		// get field values
		$fields = $this->config->item($this->tableName, 'table_fields');

		// get fields in request
		foreach ($fields as $field)
		{
			if ($this->input->input_stream($field) !== NULL)
			{
				$request[$field] = $this->input->input_stream($field);
			}
		}

		if (!isset($request))
		{
			$this->sendResponse(406);
			exit();
		}

		// update object
		$response = $this->object->update($request, $object);

		if ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
		elseif ($response === NULL) $this->sendResponse(404);
		elseif ($response) $this->sendResponse(204);
	}

	/**
	 * @param $id
     */
	public function delete($id)
	{
		// if id is 0
		if ($id === '0')
		{
			$this->sendResponse(400);
			exit();
		}

		// check if object with id exists
		$object = $this->object->get($id);
		if($object === null)
		{
			$this->sendResponse(404);
			exit();
		}

		// delete object
		if ($this->object->delete($id))
		{
			$this->sendResponse(204);
			exit();
		}
	}

	public function logout()
	{
		// unset cookies
		unset($_COOKIE);

		//unset authorization header
		unset($_SERVER['PHP_AUTH_USER']);
		unset($_SERVER['PHP_AUTH_PW']);
		unset($_SESSION);
	}
}
