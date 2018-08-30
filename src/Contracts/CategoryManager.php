<?php

namespace App\Contracts;

use App\Models\CategoryModel;

interface CategoryManager
{
	/**
	 * @return CategoryModel[]
	 */
	public function getCategories();

	public function createCategory($data): bool;

	public function removeCategory($id): bool;
}
