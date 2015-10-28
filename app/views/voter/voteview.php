<?php

class VoteView extends BaseView
{
	public function render()
	{
		$this->data->inlineScripts = [$this->readPath('app/views/_templates/scripts/vote.js')];
		$this->data->navbarLinks = $this->read('voter-navbar');
		$this->data->navbar = $this->read('base-navbar');
		$this->data->pageBody = $this->read('voter-vote');
		parent::render();
	}
}