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
	private $handlerMethod;
	private $requestMethod;
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
				//this is a string in the form: handlerName@methodToCall@requestMethod
				$handlerPartsCombined = $route[1];
				$handlerParts = explode("@", $handlerPartsCombined);
				$handler = $handlerParts[0] ."Handler";
				//handler maybe in subdirectories of handlers dir, split it to get only the class name
				$parts = explode("/", $handler);
				$class = $parts[count($parts) - 1];
				$path = strtolower($handler) . ".php";
				$this->handlerClass = $class;
				$this->handlerPath = str_replace("/",DIRECTORY_SEPARATOR,$path);
				//handlerMethod is the method that should be called from the Handler
				if(count($handlerParts) >= 2)
					$this->handlerMethod = $handlerParts[1];
				//requestMethod restricts this route to be handler only for the appropriate request (GET/POST)
				if(count($handlerParts) >= 3)
					$this->requestMethod = $handlerParts[2];
				return true;
			}
		}
		
		return false;
	}
	
	public function start(){
		
		//set app default timezone to utc
		date_default_timezone_set("Africa/Nairobi");
		
		require_once DIR_HANDLERS . DIRECTORY_SEPARATOR . $this->handlerPath;
		$handler = new $this->handlerClass();
		
		//determine which method to call
		$method = "get";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$method = "post";
		}
		
		//if handlerMethod was set in the route, use it instead
		if($this->handlerMethod){
			if(!$this->requestMethod || $this->requestMethod == $method){
				$method = $this->handlerMethod;
			}
			else {
				//TODO create mechanism for handling error responses
				header("HTTP/1.1 404 Not Found");
				die("Pafe not found!");
			}
		}
		
		if(!method_exists($handler, $method)){
			header("HTTP/1.1 404 Not Found");
			die("Page not found!");
		}
		//call onCreate() method for preprocessing
		call_user_func_array([$handler, "onCreate"], $this->args);
		//process the request using get() or post() method
		call_user_func_array([$handler, $method], $this->args);
	}
	
}