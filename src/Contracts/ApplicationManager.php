<?php
namespace App\Contracts;

interface ApplicationManager
{
	public function getCategoryManager(): CategoryManager;
	public function getCombinationManager(): CombinationManager;
}
