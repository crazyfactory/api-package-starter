<?php
namespace App\Tests\Unit;

use App\Contracts\CombinationManager;
use App\Di\Di;
use App\Di\Services;
use App\Tests\Defer;
use App\Tests\TestDi;
use App\Tests\TestingDi;
use PHPUnit\Framework\TestCase;
use App\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends TestBase
{

	public function testTest()
	{
		$userCtrl = new UserController();
		$mockRequest = Request::create("/", "POST");
		$mock = $this->createMock(CombinationManager::class);
		$mockData = [
			'id' => 1,
			'product_id' => 1,
			'combinations' => ['color' => 'WH', 'diameter' => 1.2]
		];
		$mock->method('getCombinations')->willReturn([$mockData]);
		TestDi::getInstance()->replaceInstance(Services::COMBINATION_MANAGER, $mock);
		Defer::defer($_, function() {
			TestDi::getInstance()->restore(Services::COMBINATION_MANAGER);
		});
		$mockRequest->request->replace(['status' => false, 'id' => 3, 'name' => 'my name']);
		$response = $userCtrl->test($mockRequest, 2);
		$this->assertEquals(false, $response->status);
		$this->assertEquals(3, $response->id);
		$this->assertEquals("my name", $response->name);
		$this->assertTrue($response->combinations[0]['id'] === 1);
	}
}
