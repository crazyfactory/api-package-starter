<?php

namespace App\Mocks;

use App\Contracts\CombinationManager;

class MockCombinationManager implements CombinationManager
{

	public function getCombinations(int $productId): array
	{
		return [
			[
				'id' => 1,
				'product_id' => $productId,
				'combinations' => ['color' => 'WH', 'diameter' => 1.2]
			],
			[
				'id' => 1,
				'product_id' => $productId,
				'combinations' => ['color' => 'WH', 'diameter' => 1.2]
			]
		];
	}
}
