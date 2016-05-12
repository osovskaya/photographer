<?php

class Album_images_test extends TestCase
{
	public function test_get()
	{
		$output = $this->request('GET', 'album/images/39');
		$this->assertContains(39, json_decode($output, TRUE));
		$this->assertResponseCode(200);

		$output = $this->request('GET', 'album/images/100');
		$this->assertFalse($output);
		$this->assertResponseCode(404);

		$output = $this->request('GET', 'album/images');
		$this->assertContains(1, json_decode($output, TRUE));
		$this->assertResponseCode(200);
	}

	public function test_add()
	{
		$output = $this->request('POST', 'album/images', ['album' => 'album']);
        $this->assertContains('album', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('POST', 'album/images', ['album' => 100]);
        $this->assertContains('album', json_decode($output, TRUE));
        $this->assertResponseCode(404);

        $output = $this->request('POST', 'album/images');
        $this->assertFalse($output);
		$this->assertResponseCode(400);
	}

    public function test_update()
    {
        $output = $this->request('PUT', 'album/images/39', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('PUT', 'album/images/39', ['album' => '11111111111']);
        $this->assertContains('album', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('PUT', 'album/images/100', ['name' => 'name']);
        $this->assertFalse($output);
        $this->assertResponseCode(404);

        $output = $this->request('PUT', 'album/images/39');
        $this->assertFalse($output);
        $this->assertResponseCode(400);
    }

    public function test_delete()
    {
        $output = $this->request('DELETE', 'album/images/39');
        $this->assertFalse($output);
        $this->assertResponseCode(204);

        $output = $this->request('DELETE', 'album/images/100');
        $this->assertFalse($output);
        $this->assertResponseCode(404);
    }
}
