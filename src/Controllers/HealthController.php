<?php

namespace App\Controllers;

class HealthController extends BaseController
{
	public function check()
	{
		$status = [
			'combination' => false,
			'category' => false,
			'db' => false
		];
		try {
			$this->di->resolveCombinationManager();
			$this->di->resolveCategoryManager();
			$status['combination'] = true;
			$status['category'] = true;
		} catch (\Exception $exception) {
		}
		try {
			$applicationManager = $this->di->resolveApplicationManager();
			if ($applicationManager->checkDbHealth()) {
				$status['db'] = true;
			}
		} catch (\Exception $e) {
			die($e->getMessage());
		}
		$total = count($status);
		$healthy = count(array_filter($status));
		if ($total === $healthy) {
			$status['healthy'] = true;
		}
		return $status;
	}
}
