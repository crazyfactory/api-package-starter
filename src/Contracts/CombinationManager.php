<?php
namespace App\Contracts;

interface CombinationManager
{
	public function getCombinations(int $productId): array;
}
