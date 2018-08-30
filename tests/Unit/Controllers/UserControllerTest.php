<?php
namespace App\Tests\Unit;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends TestCase
{

	public function testTest()
	{
		$userCtrl = new UserController();
		$mockRequest = Request::create("/", "POST");
		$mockRequest->request->replace(['status' => false, 'id' => 3, 'name' => 'my name']);
		$response = $userCtrl->test($mockRequest, 2);
		$this->assertEquals(false, $response->status);
		$this->assertEquals(3, $response->id);
		$this->assertEquals("my name", $response->name);
	}
}
