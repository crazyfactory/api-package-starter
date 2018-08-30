<?php

namespace App\Exceptions;

use ErrorException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Handler
{
	public function register()
	{
		register_shutdown_function(function () {
			$this->handleFatalError();
		});
		set_error_handler(function ($num, $str, $file, $line, $context = null) {
			$this->handleError($num, $str, $file, $line, $context);
		});
		set_exception_handler(function ($e) {
			$this->handleException($e);
		});
	}

	protected function handleFatalError()
	{
		$error = error_get_last();
		if ($error && $error['type'] &= E_PARSE | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR) {
			$this->handleError($error['type'], $error['message'], $error['file'], $error['line']);
		}
	}

	protected function handleError($num, $str, $file, $line, $context = null)
	{
		$e = new ErrorException($str, 0, $num, $file, $line, $context);
		$this->handleException($e);
	}

	protected function handleException($e)
	{
		$this->render($e);
	}

	protected function render($exception)
	{
		$whoops = new Run();
		$whoops->pushHandler(new PrettyPageHandler());
		$whoops->handleException($exception);
	}
}
