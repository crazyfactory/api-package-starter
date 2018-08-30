<?php
namespace App\Contracts;

interface CategoryManager
{
	public function getCategories(): array;
	public function createCategory($data): bool;
	public function removeCategory($id): bool;
}
