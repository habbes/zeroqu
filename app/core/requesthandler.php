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
		$view = new $class();
		$args = func_get_args();
		
		$view->render($this->viewParams);
		
		exit;
	}
	
	/**
	 * redirects to page relative to the root url of this site
	 * @param string $url
	 */
	public function localRedirect($url)
	{
		header("Location: ".URL_ROOT . "/$url");
		exit;
	}
	
	/**
	 * gets a GET variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 */
	public function getVar($name, $default = null)
	{
		return isset($_GET[$name])? $_GET[$name] : $default;
	}
	
	/**
	 * gets a POST variable with the given name if the variable is set
	 * @param string $name the name of the variable to retriev
	 * @param mixed $default value returned when the variable is not set
	 */
	public function postVar($name, $default = null)
	{
		return isset($_POST[$name])? $_POST[$name] : $default;
	}
	
}
