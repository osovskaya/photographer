<?php

class Albums_test extends TestCase
{
	public function test_get()
	{
		$output = $this->request('GET', 'albums/3');
		$this->assertContains(3, json_decode($output, TRUE));
		$this->assertResponseCode(200);

		$output = $this->request('GET', 'albums/100');
		$this->assertFalse($output);
		$this->assertResponseCode(404);

		$output = $this->request('GET', 'albums');
		$this->assertContains(3, json_decode($output, TRUE));
		$this->assertResponseCode(200);
	}

	public function test_add()
	{
		$output = $this->request('POST', 'albums', ['user' => 3, 'name' => 'album']);
        $this->assertContains(3, json_decode($output, TRUE));
        $this->assertResponseCode(201);

        $output = $this->request('POST', 'albums', ['role' => 'user']);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('POST', 'albums', ['user' => 100]);
        $this->assertFalse($output);
        $this->assertResponseCode(404);

        $output = $this->request('POST', 'albums');
        $this->assertFalse($output);
		$this->assertResponseCode(400);
	}

    public function test_update()
    {
        $output = $this->request('PUT', 'albums/3', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('PUT', 'albums/3', ['user' => 'user']);
        $this->assertContains('user', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('PUT', 'albums/100', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(404);

        $output = $this->request('PUT', 'albums/3');
        $this->assertFalse($output);
        $this->assertResponseCode(400);
    }

    public function test_delete()
    {
        $output = $this->request('DELETE', 'albums/3');
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('DELETE', 'albums/100');
        $this->assertFalse($output);
        $this->assertResponseCode(404);
    }
}
