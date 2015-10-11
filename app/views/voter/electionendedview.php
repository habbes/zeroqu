<?php

class ElectionEndedView extends BaseView
{
	public function render()
	{
		$this->data->navbar = $this->read('voter-navbar');
		$this->data->pageBody = $this->read('voter-election-ended');
		parent::render();
	}
}