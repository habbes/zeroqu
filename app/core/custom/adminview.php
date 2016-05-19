<?php

class AdminView extends BaseView
{
	public function renderAdminPage($params, $template)
	{
		
		if(!$this->data->styles){
			//$this->data->styles = ['layout.css', 'admin.css'];
		}
		else {
			//$this->data->styles = array_merge($this->data->styles, ['layout.css','admin.css']);
		}
	
		$this->data->userMenu = $this->read('admin-user-menu');
		$this->data->content = $this->read($template);
		$this->data->body = $this->read("main");
		$this->show("base");
	
	}
}