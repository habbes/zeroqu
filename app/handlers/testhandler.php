<?php 

class TestHandler extends RequestHandler
{
	public function get()
	{
		$this->renderView("Test");
		
	}
}

?>