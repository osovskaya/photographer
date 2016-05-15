<?php

class Albums extends MY_Controller
{
    /**
     * Albums constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load albums_model
        $this->load->model('albums_model', 'object');

        // set tablename
        $this->tableName = 'albums';
    }

    /**
     * @apiGroup albums
     *
     * @api {get} /albums/:id get information about album
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
     *       "id": "1",
     *       "user": "3",
     *       "name": "a",
     *       "active": "1",
     *       "created_at": "2016-05-08 15:34:58",
     *       "modified_at": null
     *     }
     *
     * @apiError 404 NotFound
     *
     *@apiDescription get album by id or group of albums if no id passed.
     */

    /**
     * @apiGroup albums
     *
     * @api {post} /albums/ add new album
     *
     * @apiName add
     *
     * @apiParam (Album Parameters) {String} name album name.
     * @apiParam (Album Parameters) {Number} user user id.
     *
     * @apiSuccess (Success 201) {json} object all fields and values referred to an object.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *       "id": "4",
     *       "user": "3",
     *       "name": "test",
     *       "active": "1",
     *       "created_at": "2016-05-15 22:18:57",
     *       "modified_at": null
     *     }
     *
     * @apiError 400 Empty Request
     * @apiError 404 Not Found
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription add new album.
     */

    /**
     * @apiGroup albums
     *
     * @api {put} /albums/:id update album by id
     *
     * @apiName update
     *
     * @apiParam {Number} id unique ID of an object.
     *
     * @apiParam {Number} [id = NULL] unique ID of an object.
     * @apiParam (Album Parameters) {String} [name] album name.
     * @apiParam (Album Parameters) {Number} [user] user id.
     *
     * @apiSuccess (Success 204) 204 Updated
     *
     * @apiError 400 Empty Request
     * @apiError 404 Not Found
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription update album by id.
     */

    /**
     * @apiGroup albums
     *
     * @api {delete} /albums/:id delete album by id
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
     *@apiDescription delete album by id.
     */
}
