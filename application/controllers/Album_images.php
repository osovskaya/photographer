<?php

class Album_images extends MY_Controller
{
    /**
     * Album_images constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load users_model
        $this->load->model('album_images_model', 'object');

        // set tablename
        $this->tableName = 'album/images';
    }

    /**
     * @apiGroup album/images
     *
     * @api {get} /album/images/:id get information about image
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
     *       "id": "38",
     *       "album": "100",
     *       "image": "data:image/jpeg;base64,/9j/4FwwEEpGSUZcMAEBAVwwYFwwYFwwXDD
     *       ....................................................................
     *       /Z5G3cf3a+k5rzQZ5FFwVhkVf+WiOyr/6H6n/vqu+VWnVly1IlVsLCPvR90//Z",
     *       created_at": "2016-05-10 17:14:52",
     *       "name": "///",
     *       "type": "image/jpeg"
     *     }
     *
     * @apiError 404 NotFound
     *
     *@apiDescription get image by id or group of images if no id passed.
     */

    /**
     * @apiGroup album/images
     *
     * @api {post} /album/images/ add new image
     *
     * @apiName add
     *
     * @apiParam (Album/Images Parameters) {Number} album album id.
     * @apiParam (Album/Images Parameters) {String} name image name.
     * @apiParam (Album/Images Parameters) {File} image image/jpeg or image/png.
     *
     * @apiSuccess (Success 201) {json} object all fields and values referred to an object.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *          "id": "40",
     *          "album": "100",
     *          "image": "data:image/jpeg;base64,/9j/4FwwEEpGSUZcMAEBAVwwYFwwYFwwXDD
     *          ....................................................................
     *          /Z5G3cf3a+k5rzQZ5FFwVhkVf+WiOyr/6H6n/vqu+VWnVly1IlVsLCPvR90//Z",
     *          created_at": "2016-05-10 17:14:52",
     *          "name": "1",
     *          "type": "image/jpeg"
     *     }
     *
     * @apiError 400 Empty Request
     * @apiError 404 Not Found
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription add new image.
     */
    public function add()
    {
        // if no file loaded
        if (!isset($_FILES['file'])) {
            $this->sendResponse(400);
            exit();
        }

        // get POST fields with XSS filtering
        $request = $this->input->post(NULL, TRUE);

        // add new object
        $response = $this->object->add($request);

        // if request is successful return 201 code
        // and object with userid in json format
        if ($response === NULL) $this->sendResponse(404);
        elseif ($response === false) $this->sendResponse(406, $this->form_validation->error_array());
        elseif ($response) {
            // save response in a cache
            if (!empty($response['id']))
            {
                $this->cache_model->addCache($this->tableName . $response['id'], $response, 86400);
            }
            else
            {
                $this->cache_model->addCache($this->tableName, $response, 86400);
            }

            // send Insert request in resized table
            $this->db->insert('resized', array('size' => '100', 'photo_id' => $response['id']));
            $this->db->insert('resized', array('size' => '400', 'photo_id' => $response['id']));

            $this->sendResponse(201, $response);
        }
    }

    /**
     * @apiGroup album/images
     *
     * @api {put} /album/images/:id update image by id
     *
     * @apiName update
     *
     * @apiParam {Number} id unique ID of an object.
     *
     * @apiParam {Number} [id = NULL] unique ID of an object.
     * @apiParam (Album/Images Parameters) {Number} [album] album id.
     * @apiParam (Album/Images Parameters) {String} [name] image name.
     * @apiParam (Album/Images Parameters) {File} [image] image/jpeg or image/png.
     *
     * @apiSuccess (Success 204) 204 Updated
     *
     * @apiError 400 Empty Request
     * @apiError 404 Not Found
     * @apiError 406 Not Passed Validation
     *
     *@apiDescription update image by id.
     */

    /**
     * @apiGroup album/images
     *
     * @api {delete} /album/images/:id delete image by id
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
     *@apiDescription delete image by id.
     */
}
