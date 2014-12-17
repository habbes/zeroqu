<?php

class LogoutHandler extends RequestHandler
{
	public function get()
	{
		Login::logout();
		$this->localRedirect("home");
	}
}