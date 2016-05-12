<?php

class Users_test extends TestCase
{
	public function test_get()
	{
		$output = $this->request('GET', 'users/3');
		$this->assertContains(3, json_decode($output, TRUE));
		$this->assertResponseCode(200);

		$output = $this->request('GET', 'users/100');
		$this->assertFalse($output);
		$this->assertResponseCode(404);

		$output = $this->request('GET', 'users');
		$this->assertContains(1, json_decode($output, TRUE));
		$this->assertResponseCode(200);
	}

	public function test_add()
	{
		$output = $this->request('POST', 'users', ['role' => 'client', 'name' => 'client', 'username' => 'client@client.com', 'password' => 'client']);
        $this->assertContains('client@client.com', json_decode($output, TRUE));
        $this->assertResponseCode(201);

        $output = $this->request('POST', 'users', ['role' => 'user']);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('POST', 'users');
        $this->assertFalse($output);
		$this->assertResponseCode(400);
	}

    public function test_update()
    {
        $output = $this->request('PUT', 'users/3', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('PUT', 'users/3', ['role' => 'user']);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('PUT', 'users/100', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(404);

        $output = $this->request('PUT', 'users/3');
        $this->assertFalse($output);
        $this->assertResponseCode(400);
    }

    public function test_delete()
    {
        $output = $this->request('DELETE', 'users/3');
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('DELETE', 'users/100');
        $this->assertFalse($output);
        $this->assertResponseCode(404);
    }
}
