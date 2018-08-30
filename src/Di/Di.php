<?php
namespace App\Di;

use App\Routes;
use App\Contracts\CategoryManager;
use App\Contracts\ApplicationManager;
use App\Contracts\CombinationManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Di
{
	/**
	 * @var Di $container
	 */
	protected static $container;
	/**
	 * @var ContainerBuilder $containerInstance
	 */
	protected $containerInstance;

	/**
	 * @return Di
	 * @throws \Exception
	 */
	public static function getInstance(): Di {
		if (!self::$container) {
			self::$container = new self(new ContainerBuilder());
		}
		return self::$container;
	}

	public static function overWriteInstance(Di $di) {
		self::$container = $di;
	}

	/**
	 * Di constructor.
	 * @param ContainerBuilder $container
	 * @throws \Exception
	 */
	function __construct(ContainerBuilder $container)
	{
		$this->containerInstance = $container;
		$this->registerDefaults();
	}

	public function register($id, $class) {
		$this->containerInstance->register($id, $class);
	}

	public function set($id, $instance) {
		$this->containerInstance->set($id, $instance);
	}

	public function setApplicationManager(ApplicationManager $applicationManager) {
		$this->set(Services::CATEGORY_MANAGER, $applicationManager->getCategoryManager());
		$this->set(Services::COMBINATION_MANAGER, $applicationManager->getCombinationManager());
		$this->set(Services::APPLICATION_MANAGER, $applicationManager);
	}

	public function get($id) {
		return $this->containerInstance->get($id);
	}
	/**
	 * @return CategoryManager
	 * @throws \Exception
	 */
	public function resolveCategoryManager(): CategoryManager {
		$categoryManager = $this->containerInstance->get(Services::CATEGORY_MANAGER);
		if (!$categoryManager instanceof CategoryManager) {
			throw new \Exception("Category Manager not found");
		}
		return $categoryManager;
	}

	/**
	 * @return CombinationManager
	 * @throws \Exception
	 */
	public function resolveCombinationManager(): CombinationManager {
		$combinationManager = $this->containerInstance->get(Services::COMBINATION_MANAGER);
		if (!$combinationManager instanceof CombinationManager) {
			throw new \Exception("Category Manager not found");
		}
		return $combinationManager;
	}

	/**
	 * @return ApplicationManager
	 * @throws \Exception
	 */
	public function resolveApplicationManager(): ApplicationManager {
		$applicationManager = $this->containerInstance->get(Services::APPLICATION_MANAGER);
		if (!$applicationManager instanceof ApplicationManager) {
			throw new \Exception("Application Manager not found");
		}
		return $applicationManager;
	}

	/**
	 * @return RouteCollection
	 * @throws \Exception
	 */
	public function resolveRoutes(): RouteCollection {
		$routeCollection = $this->containerInstance->get("routes");
		if (!$routeCollection instanceof RouteCollection) {
			throw new \Exception("Routes not found in DI container");
		}
		return $routeCollection;
	}

	/**
	 * @return UrlMatcher
	 * @throws \Exception
	 */
	public function resolveUrlMatcher(): UrlMatcher {
		$matcher = $this->containerInstance->get("matcher");
		if (!$matcher instanceof UrlMatcher) {
			throw new \Exception("Url matcher not found in DI container");
		}
		return $matcher;
	}

	/**
	 * @return Request
	 * @throws \Exception
	 */
	public function resolveRequest(): Request {
		$request = $this->containerInstance->get("request");
		if (!$request instanceof Request) {
			throw new \Exception("Request not found in DI container");
		}
		return $request;
	}

	/**
	 * @return ControllerResolver
	 * @throws \Exception
	 */
	public function resolveControllerResolver(): ControllerResolver {
		$controller_resolver = $this->containerInstance->get("controller_resolver");
		if (!$controller_resolver instanceof ControllerResolver) {
			throw new \Exception("Controller Resolver not found in DI container");
		}
		return $controller_resolver;
	}

	/**
	 * @return ArgumentResolver
	 * @throws \Exception
	 */
	public function resolveArgumentResolver(): ArgumentResolver {
		$controller_resolver = $this->containerInstance->get("argument_resolver");
		if (!$controller_resolver instanceof ArgumentResolver) {
			throw new \Exception("Controller Resolver not found in DI container");
		}
		return $controller_resolver;
	}

	/**
	 * @throws \Exception
	 */
	private function registerDefaults() {
		$this->registerRoutes();
		$this->registerRequest();
		$this->registerControllerResolver();
		$this->registerArgumentResolver();
	}

	private function registerArgumentResolver() {
		$this->register("argument_resolver", ArgumentResolver::class);
	}

	private function registerControllerResolver() {
		$this->register("controller_resolver", ControllerResolver::class);
	}

	private function registerRoutes(): void {
		$routeCollection = new RouteCollection();
		$routeCollection = (new Routes())->registerRoutes($routeCollection);
		$this->set("routes", $routeCollection);
	}

	/**
	 * @throws \Exception
	 */
	private function registerRequest(): void {
		$request = Request::createFromGlobals();
		$context = (new RequestContext())->fromRequest($request);
		$matcher = new UrlMatcher($this->resolveRoutes(), $context);
		$this->set("request", Request::createFromGlobals());
		$this->set("matcher", $matcher);
	}
}
