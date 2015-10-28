<?php

class HomeView extends BaseView
{
	public function render($params = null)
	{
		$this->data->homeLogo = true;
		$this->data->pageBody = $this->read('home-body');
		$this->data->navbar = $this->read('home-navbar');
		parent::render();
	}
}