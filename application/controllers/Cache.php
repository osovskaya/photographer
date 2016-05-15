<?php

class Cache extends CI_Controller
{
    /**
     * Cache constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // load cache_model
        $this->load->model('cache_model');
    }

    /**
     * @apiGroup cache
     *
     * @api {get} /memcached/ get list of keys stored in cache
     *
     * @apiName view
     *
     * @apiSuccess 200 OK, Memcached viewer.
     *
     * @apiError 404 NotFound
     *
     *@apiDescription get list of keys stored in cache.
     */
    public function view()
    {
        $cacheData = $this->cache_model->view();
        if (!$cacheData)
        {
            echo 'Cache is empty!';
            exit();
        }

        if (!file_exists(APPPATH.'views/cache.php'))
        {
            show_404();
        }

        require_once(APPPATH.'views/cache.php');
    }

    /**
     * @apiGroup cache
     *
     * @api {get} /memcached/:key delete cache by key
     *
     * @apiName delete
     *
     * @apiParam {String} key memcache key.
     *
     * @apiSuccess 200 OK
     *
     *@apiDescription delete cache by key.
     */
    public function delete($key)
    {
        $this->cache_model->deleteCache($key);
        header('Location: /memcached');
    }
}