<?php

class Main_test extends TestCase
{
	public function test_users_get_id()
	{
		$output = $this->request('GET', 'users/1');
		$this->assertEquals(
			'{
    "id": "1",
    "role": "admin",
    "name": "ann",
    "username": "ann",
    "password": "ann",
    "token": "0c5355b0a892e5cbf046bef9a75d40745cb12735ec887a5029c3e37e00c29116",
    "phone": null,
    "modified_at": null,
    "created_at": "2016-04-04 11:36:55"
}',
			$output
		);
		$this->assertResponseCode('200');
	}

	public function test_users_get_id_user_not_found()
	{
		$output = $this->request('GET', ['users/2']);
		$this->assertResponseCode(404);
	}

	public function test_users_get()
	{
		try {
			$output = $this->request('GET', 'users');
		} catch (CIPHPUnitTestExitException $e) {
			$output = ob_get_clean();
		}
		$this->assertEquals(
			'[
    {
        "id": "1",
        "role": "admin",
        "name": "ann",
        "username": "ann",
        "password": "ann",
        "token": "0c5355b0a892e5cbf046bef9a75d40745cb12735ec887a5029c3e37e00c29116",
        "phone": null,
        "modified_at": null,
        "created_at": "2016-04-04 11:36:55"
    }
]',
			$output
		);
		$this->assertResponseCode('200');
	}

	public function test_users_add()
	{
		$output = $this->request('POST', 'users', ['role' => 'admin', 'name' => 'test', 'username' => 'test1234', 'password' => 'test'];
		$this->assertResponseCode('201');
	}

	public function test_users_post_emptyrequest()
	{
		$output = $this->request('POST', 'users');
		$this->assertResponseCode('400');
	}


}
