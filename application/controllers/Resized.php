<?php

class Resized extends MY_Controller
{
    /**
     * Resized constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');

        // load users_model
        $this->load->model('resized_model', 'object');
        
        // set tablename
        $this->tableName = 'resized';
    }

    /**
     * @apiGroup resized
     *
     * @api {get} /reset/:id get information about resized image
     *
     * @apiName get
     *
     * @apiParam {Number} [id = NULL] unique photo_id of an image.
     *
     * @apiSuccess {json} object all fields and values referred to an object.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "size": "100",
     *          "photo_id": "39",
     *          "src": "application/data/images/resized/3/100_39.jpg",
     *          "status": "complete",
     *          "comment": null,
     *          "id": "2"
     *     }
     *
     * @apiError 404 NotFound
     *
     *@apiDescription get resized image by image id
     */
}
