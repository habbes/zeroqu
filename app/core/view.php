<?php

/**
 * Base View
 * A view generates the output html that is presented to the client
 * @author Habbes
 *
 */
abstract class View
{
	
	/**
	 * data passed to and accessible from a template displayed by this view
	 * @var DataObject
	 */
	protected $data;
	
	public function __construct()
	{
		$this->data = new DataObject();
	}
	
	/**
	 * display the view
	 */
	public function render($options = null)
	{
		
	}
	
	/**
	 * get the specified template file
	 * @param string $template
	 * @return string
	 */
	public function template($template)
	{
		$ds = DIRECTORY_SEPARATOR;
		return DIR_VIEWS . $ds ."_templates" . $ds . str_replace("/",$ds,$template).".php";
	}
	
	/**
	 * display the specified template
	 * @param string $template
	 */
	public function show($template)
	{
		$data = $this->data;
		include $this->template($template);
	}
	
	/**
	 * gets the output of the specified template
	 * @param string $template
	 * @return string
	 */
	public function read($template)
	{
		ob_start();
		$data = $this->data;
		include $this->template($template);
		return ob_get_clean();
	}
	
	public function readPath($path)
	{
		ob_start();
		$data = $this->data;
		$ds = DIRECTORY_SEPARATOR;
		$path = str_replace("/", $ds, $path);
		include DIR_ROOT.$ds.$path;
		return ob_get_clean();
	}
	
	

}