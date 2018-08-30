<?php
namespace App\Tests\Unit\Controllers;

use App\Contracts\ApplicationManager;
use App\Contracts\CategoryManager;
use App\Contracts\CombinationManager;
use App\Controllers\HealthController;
use App\Di\Services;
use App\Tests\Defer;
use App\Tests\TestDi;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HealthControllerTest extends TestCase
{
	/**
	 * @var MockObject
	 */
	private $combinationManager, $categoryManager, $applicationManager;
	public function setUp()
	{
		$combinationManager = $this->createMock(CombinationManager::class);
		$categoryManager = $this->createMock(CategoryManager::class);
		$applicationManager = $this->createMock(ApplicationManager::class);
		$applicationManager->method('getCategoryManager')->willReturn($categoryManager);
		$applicationManager->method('getCombinationManager')->willReturn($combinationManager);
		$applicationManager->method('checkDbHealth')->willReturn(true);
		$this->combinationManager = $combinationManager;
		$this->categoryManager = $categoryManager;
		$this->applicationManager = $applicationManager;
	}

	public function testCheckReturnsHealthyIfEverythingHealthy()
	{
		TestDi::getInstance()->replaceInstance(Services::APPLICATION_MANAGER, $this->applicationManager);
		TestDi::getInstance()->replaceInstance(Services::COMBINATION_MANAGER, $this->combinationManager);
		TestDi::getInstance()->replaceInstance(Services::CATEGORY_MANAGER, $this->categoryManager);
		Defer::defer($_, function() {
			TestDi::getInstance()->restore(Services::APPLICATION_MANAGER);
			TestDi::getInstance()->restore(Services::COMBINATION_MANAGER);
			TestDi::getInstance()->restore(Services::CATEGORY_MANAGER);
		});
		$controller = new HealthController();
		$response = $controller->check();
		$this->assertTrue($response['healthy']);
	}

	/**
	 * @throws \Exception
	 * @runInSeparateProcess
	 */
	public function testCheckReturnsUnhealthyIfManagerAreNotProvided() {
		TestDi::getInstance()->replaceInstance(Services::APPLICATION_MANAGER, $this->applicationManager);
		TestDi::getInstance()->replaceInstance(Services::COMBINATION_MANAGER, $this->combinationManager);
		Defer::defer($_, function() {
			TestDi::getInstance()->restore(Services::APPLICATION_MANAGER);
			TestDi::getInstance()->restore(Services::COMBINATION_MANAGER);
		});
		$controller = new HealthController();
		$response = $controller->check();
		$this->assertFalse($response['healthy']);
	}
	/**
	 * @throws \Exception
	 * @runInSeparateProcess
	 */
	public function testCheckReturnsUnhealthyIfApplicationManagerIsNotProvided() {
		TestDi::getInstance()->replaceInstance(Services::COMBINATION_MANAGER, $this->combinationManager);
		TestDi::getInstance()->replaceInstance(Services::CATEGORY_MANAGER, $this->categoryManager);
		Defer::defer($_, function() {
			TestDi::getInstance()->restore(Services::COMBINATION_MANAGER);
			TestDi::getInstance()->restore(Services::CATEGORY_MANAGER);
		});
		$controller = new HealthController();
		$response = $controller->check();
		$this->assertFalse($response['healthy']);
	}
	public function testCheckReturnsUnhealthyIfDatabaseIsUnHealthy() {
		$this->applicationManager = $this->createMock(ApplicationManager::class);
		$this->applicationManager->method('checkDbHealth')->willReturn(false);
		$this->applicationManager->method('getCategoryManager')->willReturn($this->categoryManager);
		$this->applicationManager->method('getCombinationManager')->willReturn($this->combinationManager);
		TestDi::getInstance()->replaceInstance(Services::APPLICATION_MANAGER, $this->applicationManager);
		TestDi::getInstance()->replaceInstance(Services::COMBINATION_MANAGER, $this->combinationManager);
		TestDi::getInstance()->replaceInstance(Services::CATEGORY_MANAGER, $this->categoryManager);
		Defer::defer($_, function() {
			TestDi::getInstance()->restore(Services::APPLICATION_MANAGER);
			TestDi::getInstance()->restore(Services::COMBINATION_MANAGER);
			TestDi::getInstance()->restore(Services::CATEGORY_MANAGER);
		});
		$controller = new HealthController();
		$response = $controller->check();
		var_dump($response);
		$this->assertFalse($response['healthy']);
	}
}
