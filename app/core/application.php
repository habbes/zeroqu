<?php
/**
 * App Class, gets the appropriate handler for the url and starts the handler
 * @author Habbes
 *
 */
class Application
{
	
	private $url;
	private $routes;
	private $handlerClass;
	private $handlerPath;
	private $method;
	private $args;
	private $controller;
	
	/**
	 * 
	 * @param string $url
	 * @param array $routes url/Handler pairs mapping url to its request handler
	 */
	public function __construct($url, $routes)
	{
		$this->url = $url;
		$this->routes = $routes;
		$this->findHandler() or die("Page not found!");
		Session::getInstance();
	}
	
	private function findHandler()
	{
		foreach($this->routes as $route){
			if(preg_match('/'.$route[0].'/', $this->url, $args)){
				$this->args = array_slice($args, 1);
				$handler = $route[1] . "Handler";
				$parts = explode("/", $handler);
				$class = $parts[count($parts) - 1];
				$path = strtolower($handler) . ".php";
				$this->handlerClass = $class;
				$this->handlerPath = str_replace("/",DIRECTORY_SEPARATOR,$path);
				return true;
			}
		}
		
		return false;
	}
	
	public function start(){
		require_once DIR_HANDLERS . DIRECTORY_SEPARATOR . $this->handlerPath;
		$handler = new $this->handlerClass();
		$method = "get";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$method = "post";
		}
		
		if(!method_exists($handler, $method)){
			die("Page not found!");
		}
		//call onCreate() method for preprocessing
		call_user_method_array("onCreate", $handler, $this->args);
		//process the request using get() or post() method
		call_user_method_array($method, $handler, $this->args);
	
	}
	


}