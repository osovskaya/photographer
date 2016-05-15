<?php

class Users extends MY_Controller
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load users_model
        $this->load->model('users_model', 'object');
        
        // set tablename
        $this->tableName = 'users';
    }

    /**
     * @apiGroup users
     *
     * @api {get} /users/:id get information about user
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
     *@apiDescription get user by id or group of users if no id passed.
     */

    /**
     * @apiGroup users
     *
     * @api {post} /users/ add new user
     *
     * @apiName add
     *
     * @apiParam (Users Parameters) {String} role user role form a list (admin, photographer, client).
     * @apiParam (Users Parameters) {String} name user name.
     * @apiParam (Users Parameters) {String} username unique username.
     * @apiParam (Users Parameters) {String} password user password.
     * @apiParam (Users Parameters) {Number} [phone] user phone.
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
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription add new user.
     */

    /**
     * @apiGroup users
     *
     * @api {put} /users/:id update user by id
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
     * @apiSuccess (Success 204) 204 Updated
     *
     * @apiError 400 Empty Request
     * @apiError 404 Not Found
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription update user by id.
     */

    /**
     * @apiGroup users
     *
     * @api {delete} /users/:id delete user by id
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
     *@apiDescription delete user by id.
     */
}
