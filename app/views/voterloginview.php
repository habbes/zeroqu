<?php

class VoterLoginView extends View
{
	public function render()
	{
		$this->data->body = $this->read('voter-login');
		$this->show('base');
	}
}