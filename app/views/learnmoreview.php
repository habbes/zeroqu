<?php
class LearnmoreView extends BaseView{
    public function render($params = null)
	{
		$this->data->homeLogo = true;
		$this->data->pageBody = $this->read('learnmore-body');
		$this->data->navbar = $this->read('home-navbar');
		parent::render();
	}
}