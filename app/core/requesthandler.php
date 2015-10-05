<?php

/**
 * Base request handler
 * @author Habbes
 *
 */
abstract class RequestHandler
{
	
	/**
	 * parameters passed to the view when renderView() is called
	 * @var DataObject
	 */
	protected $viewParams;
	
	public function __construct()
	{
		$this->viewParams = new DataObject();
	}
	
	/**
	 * gets the instance of the current session
	 * @return Session
	 */
	public function session()
	{
		return Session::getInstance();
	}
	
	/**
	 * this method is called before the get() or post() method.
	 * It is used to implement some initial checking or processing before the
	 * the request is handled by the get/post method. It is passed the
	 * same arguments that will be passed to the get/post methods.
	 */
	public function onCreate()
	{
		
	}
	
	//the concrete class should implement public get() and post() methods to be called
	//by the instance of Application
	
	/**
	 * Render the selected view
	 * @param string $view relative path to View
	 */
	public function renderView($viewPath)
	{
		$viewPath = $viewPath . "View";
		$parts = explode("/", $viewPath);
		$class = $parts[count($parts) - 1];
		
		$ds = DIRECTORY_SEPARATOR;
		$viewPath = str_replace("/", $ds, $viewPath);
		include DIR_VIEWS.$ds.strtolower($viewPath).".php";
		$view = new $class($this->viewParams);
		$args = func_get_args();
		
		$view->render();
		
		
		exit;
	}
	
	/**
	 * redirects to page relative to the root url of this site
	 * @param string $url
	 */
	public function localRedirect($url)
	{
		if(URL_ROOT_SUBPATH && strpos($url, URL_ROOT_SUBPATH) === 0)
			$url = substr($url, strlen(URL_ROOT_SUBPATH));
		
		if(substr($url, 0, 1) != "/")
			$url = "/".$url;
		$this->redirect(URL_ROOT.$url);
	
	}
	
	/**
	 * rediects to the specified absolute url
	 * @param string $url
	 */
	public function redirect($url)
	{
		header("Location: ".$url);
		exit;
	}
	
	/**
	 * redirects back to the current page
	 */
	public function reloadPage()
	{
		$this->localRedirect($_SERVER['REQUEST_URI']);
	}
	
	/**
	 * gets a GET variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 * @returns string
	 */
	public function getVar($name, $default = null)
	{
		return isset($_GET[$name])? $_GET[$name] : $default;
	}
	
	/**
	 * gets a trimmed GET variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 * @returns string
	 */
	public function trimGetVar($name, $default = null)
	{
		return trim($this->getVar($name, $default));
	}
	
	/**
	 * gets a POST variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 * @return string
	 */
	public function postVar($name, $default = null)
	{
		return isset($_POST[$name])? $_POST[$name] : $default;
	}
	
	/**
	 * gets a trimmed POST variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 * @returns string
	 */
	public function trimPostVar($name, $default = null)
	{
		return trim($this->postVar($name, $default));
	}
	
	/**
	 * gets a FILE variable with the given name and returns an object with the file's metadata
	 * @param string $name
	 * @param mixed $default
	 * @return StdClass
	 */
	public function fileVar($name, $default = null)
	{
		if(!isset($_FILES[$name]))
			return $default;
		
		$file = $_FILES[$name];
		
		return (object) $file;
	}
	
}
