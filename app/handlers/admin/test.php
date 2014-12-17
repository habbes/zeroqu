<?php

class Test extends RequestHandler
{
	public function get($name="", $id="")
	{
		echo "admin name=$name, id=$id";
	}
}