<?php

class Resized_test extends TestCase
{
	public function test_get()
	{
		$output = $this->request('GET', 'resized/39');
		$this->assertContains(39, json_decode($output, TRUE));
		$this->assertResponseCode(200);

        $output = $this->request('GET', 'resized/39?status=3');
        $this->assertNotContains('new', json_decode($output, TRUE));
        $this->assertResponseCode(200);

		$output = $this->request('GET', 'resized/100');
		$this->assertFalse($output);
		$this->assertResponseCode(404);

		$output = $this->request('GET', 'resized');
		$this->assertContains(39, json_decode($output, TRUE));
		$this->assertResponseCode(200);

        $output = $this->request('GET', 'resized?status=1');
        $this->assertNotContains('complete', json_decode($output, TRUE));
        $this->assertResponseCode(200);
	}

	public function test_add()
	{
		$output = $this->request('POST', 'resized', ['size' => '100', 'photo_id' => 39]);
        $this->assertContains('39', json_decode($output, TRUE));
        $this->assertResponseCode(201);

        $output = $this->request('POST', 'resized', ['photo_id' => 'photo_id']);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('POST', 'resized', ['photo_id' => 100]);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(404);

        $output = $this->request('POST', 'resized');
        $this->assertFalse($output);
		$this->assertResponseCode(400);
	}

    public function test_update()
    {
        $output = $this->request('PUT', 'resized/39', ['size' => '400', 'status' => 'error']);
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('PUT', 'resized/39', ['size' => '400', 'status' => 'status']);
        $this->assertContains('role', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('PUT', 'resized/100', ['size' => '400']);
        $this->assertFalse($output);
        $this->assertResponseCode(404);

        $output = $this->request('PUT', 'resized/39');
        $this->assertFalse($output);
        $this->assertResponseCode(400);
    }

    public function test_delete()
    {
        $output = $this->request('DELETE', 'resized/39');
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('DELETE', 'resized/100');
        $this->assertFalse($output);
        $this->assertResponseCode(404);
    }
}
