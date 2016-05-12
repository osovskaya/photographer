<?php

class Cache_test extends TestCase
{
	public function test_view()
	{
		$this->request('GET', 'memcached');
		$this->assertResponseCode(200);
	}

	public function test_delete()
	{
		$output = $this->request('DELETE', 'memcached/users1');
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('DELETE', 'memcached/users100');
        $this->assertFalse($output);
        $this->assertResponseCode(404);
	}
}
