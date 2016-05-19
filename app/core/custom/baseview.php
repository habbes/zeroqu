<?php
class BaseView extends View
{
	public function render()
	{
		$this->show('ui-base');
	}
}