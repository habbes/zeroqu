<?php

class VoterLoginView extends BaseView
{
	public function render()
	{
		$this->data->navbar = $this->read('default-navbar');
		$this->data->pageBody = $this->read('voter-login');
		parent::render();
	}
}