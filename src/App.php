<?php
namespace App;

use App\Contracts\ApplicationManager;
use App\Di\Di;
use App\Exceptions\Handler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class App
{
	private $di;

	/**
	 * App constructor.
	 * @param ApplicationManager $applicationManager
	 * @throws \Exception
	 */
	public function __construct(ApplicationManager $applicationManager)
	{
		(new Handler())->register();
		$this->di = Di::getInstance();
		$this->di->set('application_manager', $applicationManager);
	}

	/**
	 * @throws \Exception
	 */
	public function handle() {
		try {
			$matcher = $this->di->resolveUrlMatcher();
			$request = $this->di->resolveRequest();
			$attributes = $matcher->match($request->getPathInfo());
			$request->attributes->add($attributes);
			$controller = $this->di->resolveControllerResolver()->getController($request);
			$arguments = $this->di->resolveArgumentResolver()->getArguments($request, $controller);
			$this->dispatch($controller, $arguments);
		} catch (ResourceNotFoundException $e) {
			die("route not found");
		}
	}
	protected function dispatch($controller, $arguments) {
		$response = call_user_func_array($controller, $arguments);
		if ($response instanceof Response) {
			$response->send();
		} else {
			JsonResponse::create($response)->send();
		}
	}
}
