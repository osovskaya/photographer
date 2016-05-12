<?php

class Reset_test extends TestCase
{
	public function test_mail()
	{
		$this->request('POST', 'reset', ['email' => 'test@test.com']);
		$this->assertResponseCode(201);

        $output = $this->request('POST', 'reset', ['email' => 'test']);
        $this->assertContains('email', json_decode($output, TRUE));
        $this->assertResponseCode(406);

        $output = $this->request('POST', 'reset', ['email' => 'test@no.com']);
        $this->assertContains('email', json_decode($output, TRUE));
        $this->assertResponseCode(404);

        $output = $this->request('POST', 'reset');
        $this->assertFalse($output);
		$this->assertResponseCode(400);
	}

    public function test_password()
    {
        $this->request('PUT', 'reset', ['password' => 'password', 'code' => '11111']);
        $this->assertResponseCode(404);

        $output = $this->request('PUT', 'reset', ['password' => 'password', 'code' => '4b7bfc18af74c2713172a2cbe720ae6d09c2f97eef50ca73630cbc98cb820d8d']);
        $this->assertFalse($output);
        $this->assertResponseCode(406);

        $output = $this->request('PUT', 'reset');
        $this->assertFalse($output);
        $this->assertResponseCode(400);
    }
}
