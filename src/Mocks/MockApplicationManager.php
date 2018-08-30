<?php
namespace App\Mocks;

use App\Contracts\ApplicationManager;
use App\Contracts\CategoryManager;
use App\Contracts\CombinationManager;

class MockApplicationManager implements ApplicationManager
{

	public function getCategoryManager(): CategoryManager
	{
		return new MockCategoryManager();
	}

	public function getCombinationManager(): CombinationManager
	{
		return new MockCombinationManager();
	}
}
