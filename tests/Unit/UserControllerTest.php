<?php
namespace App\Tests\Unit;

use App\Controller\UserController;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{

	public function testTest()
	{
		$userCtrl = new UserController();
		$this->assertEquals(['key' => 2], $userCtrl->test(2));
	}
}
