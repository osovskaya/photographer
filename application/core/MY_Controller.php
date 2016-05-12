<?php

class MY_Controller extends CI_Controller
{
    public $tableName = NULL;

	public function __construct()
	{
		parent::__construct();

		// load cache_model
		$this->load->model('cache_model');
	}
    
	/**
	 * @api {get} /object_name/:id get information about object
	 *
	 * @apiName get
	 *
	 * @apiParam {Number} [id = NULL] unique ID of an object.
	 *
	 * @apiSuccess {json} object all fields and values referred to an object.
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "id": "5",
	 *       "role": "client",
	 *       "name": "client",
	 *       "username": "client",
	 *       "password": "client",
	 *       "token": null,
	 *       "phone": null,
	 *       "modified_at": null,
	 *       "created_at": "2016-04-04 11:36:55"
	 *     }
	 *
	 * @apiError 404 NotFound
	 *
	 *@apiDescription get object by id or group of objects if no id passed.
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
	 * @api {post} /object_name/ add new object
	 *
	 * @apiName add
	 *
	 * @apiParam (User Parameters) {String} role user role form a list (admin, photographer, client).
	 * @apiParam (User Parameters) {String} name user name.
	 * @apiParam (User Parameters) {String} username unique username.
	 * @apiParam (User Parameters) {String} password user password.
	 * @apiParam (User Parameters) {Number} [phone] user phone.
	 * 
	 * @apiParam (Album Parameters) {String} name album name.
	 * @apiParam (Album Parameters) {Number} user user id.
	 * 
	 * @apiParam (Album/Images Parameters) {Number} album album id.
	 * @apiParam (Album/Images Parameters) {String} name image name.
	 * @apiParam (Album/Images Parameters) {File} image image/jpeg or image/png.
	 *
	 * @apiParam (Resized Parameters) {String} size size of a resized image.
	 * @apiParam (Resized Parameters) {Number} photo_id image id.
	 * @apiParam (Resized Parameters) {String} [comment] comment.
	 *
	 * @apiSuccess (Success 201) {json} object all fields and values referred to an object.
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *     HTTP/1.1 201 Created
	 *     {
	 *		"id": "12",
	 *		"user": "88",
	 *		"name": "test",
	 *		"active": "1",
	 *		"created_at": "2016-04-26 16:57:23",
	 *		"modified_at": null
	 *     }
	 *
	 * @apiError 400 Empty Request
	 * @apiError 404 Not Found
	 * @apiError 406 Not Passed Validation
	 *
	 *@apiDescription add new object.
	 */
	public function add()
	{
		//if post body empty, return code 400
		if (!$this->input->raw_input_stream)
		{
			$this->sendResponse(400);
			exit();
		}

		// add new object
		$response = $this->object->add();

		// if request is successful return 201 code
		// and object with userid in json format
		if ($response === NULL) $this->sendResponse(404);
		elseif ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
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
	 * @api {put} /object_name/:id update object by id
	 *
	 * @apiName update
	 *
	 * @apiParam {Number} id unique ID of an object.
	 *
	 * @apiParam (User Parameters) {String} [role] user role form a list (admin, photographer, client).
	 * @apiParam (User Parameters) {String} [name] user name.
	 * @apiParam (User Parameters) {String} [username] unique username.
	 * @apiParam (User Parameters) {String} [password] user password.
	 * @apiParam (User Parameters) {Number} [phone] user phone.
	 *
	 * @apiParam {Number} [id = NULL] unique ID of an object.
	 * @apiParam (Album Parameters) {String} [name] album name.
	 * @apiParam (Album Parameters) {Number} [user] user id.
	 *
	 * @apiParam {Number} [id = NULL] unique ID of an object.
	 * @apiParam (Album/Images Parameters) {Number} [album] album id.
	 * @apiParam (Album/Images Parameters) {String} [name] image name.
	 * @apiParam (Album/Images Parameters) {File} [image] image/jpeg or image/png.
	 *
	 * @apiParam {Number} [id = NULL] photo_id image id.
	 * @apiParam (Resized Parameters) {String} size size of a resized image.
	 * @apiParam (Resized Parameters) {String} [src] path to resized image.
	 * @apiParam (Resized Parameters) {String} [status] status.
	 * @apiParam (Resized Parameters) {String} [comment] comment.
	 *
	 * @apiSuccess (Success 204) 204 Updated
	 *
	 * @apiError 400 Empty Request
	 * @apiError 404 Not Found
	 * @apiError 406 Not Passed Validation
	 *
	 *@apiDescription update object by id.
	 */
	public function update($id)
	{
		// if put body empty
		if (!$this->input->raw_input_stream)
		{
			$this->sendResponse(400);
			exit();
		}

		// update object
		$response = $this->object->update($id);

		if ($response === NULL) $this->sendResponse(404);
		elseif ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
		elseif ($response) $this->sendResponse(204);
	}

	/**
	 * @api {delete} /object_name/:id delete object by id
	 *
	 * @apiName delete
	 *
	 * @apiParam {Number} id unique ID of an object.
	 *
	 * @apiSuccess (Success 204) 204 Updated
	 *
	 * @apiError 400 Empty Request
	 * @apiError 404 Not Found
	 *
	 *@apiDescription delete object by id.
	 */
	public function delete($id)
	{
		// if id is 0
		if ($id === '0')
		{
			$this->sendResponse(400);
			exit();
		}

		// delete object
		$response = $this->object->delete($id);

		if ($response === NULL) $this->sendResponse(404);
		elseif ($response) $this->sendResponse(204);
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
