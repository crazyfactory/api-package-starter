<?php
namespace App\Contracts;

interface ApplicationManager
{
	public function getCategoryManager(): CategoryManager;
	public function getCombinationManager(): CombinationManager;

	/**
	 * should do a SELECT TRUE or maybe SELECT order_id FROM orders LIMIT 1 so we know everything is fine.
	 * @return bool
	 */
	public function checkDbHealth(): bool;
}
