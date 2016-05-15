<?php

class Cache_model extends Memcached
{
    /**
     * Cache_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->addServer('localhost', 11211);

        date_default_timezone_set('Europe/Kiev');
    }

    /**
     * @return bool
     */
    public function view()
    {
        $keys = $this->getAllKeys();

        if (empty($keys))
        {
            return false;
        }

        foreach($keys as $key)
        {
            $cacheData[$key] = $this->get($key);
        }

        return $cacheData;
    }

    /**
     * @param $key
     * @param $value
     * @param int $expiration
     * @return bool
     */
    public function addCache($key, $value, $expiration = 0)
    {
        $data['cacheValue'] = $value;
        $data['created'] = time();
        $data['expires'] = time() + $expiration;
        $this->set($key, $data, $expiration);
        return true;
    }

    public function deleteCache($key)
    {
        $this->delete($key);
        return true;
    }

}

$cache = new Cache_model('photo');


