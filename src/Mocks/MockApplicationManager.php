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

	/**
	 * should do a SELECT TRUE or maybe SELECT order_id FROM orders LIMIT 1 so we know everything is fine.
	 * @return bool
	 */
	public function checkDbHealth(): bool
	{
		return true;
	}
}
