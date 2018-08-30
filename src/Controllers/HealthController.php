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
			$status['combination'] = true;
			$this->di->resolveCategoryManager();
			$status['category'] = true;
		} catch (\Exception $exception) {
		}
		try {
			$applicationManager = $this->di->resolveApplicationManager();
			if ($applicationManager->checkDbHealth()) {
				$status['db'] = true;
			}
		} catch (\Exception $e) {
		}
		$total = count($status);
		$healthy = count(array_filter($status));
		if ($total === $healthy) {
			$status['healthy'] = true;
		} else {
			$status['healthy'] = false;
		}
		return $status;
	}
}
