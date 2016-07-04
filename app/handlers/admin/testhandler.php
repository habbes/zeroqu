<?php

class TestHandler extends AdminElectionHandler
{
	public function get($name="", $id="")
	{
		print_r($this->election->createCustomProperty("graduation"));
	}
}