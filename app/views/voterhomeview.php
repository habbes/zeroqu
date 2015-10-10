<?php

class VoterHomeView extends BaseView
{
	public function render()
	{
		$this->data->positions = $this->data->election->getPositions();
		$this->data->navbar = $this->read('voter-navbar');
		$this->data->pageBody = $this->read('voter-candidates');
		parent::render();
	}
}