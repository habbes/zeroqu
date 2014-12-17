<?php

class HomeView extends View
{
	public function render($params)
	{
		$this->data->signupResult = $params->signupResult;
		$this->data->loginResult = $params->loginResult;
		$this->data->voterLoginResult = $params->voterLoginResult;
		$this->data->subtitle = "Home";
		$this->data->styles = ["home.css"];
		$this->data->body = $this->read("home");
		$this->show("base");
	}
}