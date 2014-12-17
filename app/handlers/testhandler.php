<?php 

class TestHandler extends RequestHandler
{
	public function get($name)
	{
		echo "Hello, $name";
		
	}
}

?>