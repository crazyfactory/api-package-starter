<?php

namespace App\Mocks;

use App\Contracts\CategoryManager;

class MockCategoryManager implements CategoryManager
{

	public function getCategories(): array
	{
		return [
			[
				'id' => 1,
				'category_name' => 'plugs'
			],
			[
				'id' => 2,
				'category_name' => 'tunnels'
			],
			[
				'id' => 3,
				'category_name' => 'something else'
			]
		];
	}

	public function createCategory($data): bool
	{
		return true;
	}

	public function removeCategory($id): bool
	{
		return true;
	}
}
