<?php

class AdminView extends View
{
	
	public function renderAdminPage($params, $template)
	{
		$this->data->elections = $params->admin->getElections();
		$this->data->username = $params->admin->getUsername();
		if(!$this->data->styles){
			$this->data->styles = ['layout.css', 'admin.css'];		
		}
		else {
			$this->data->styles = array_merge($this->data->styles, ['layout.css','admin.css']);
		}
		
		$this->data->menu = $this->read("admin_menu");
		$this->data->content = $this->read($template);
		$this->data->body = $this->read("main");
		$this->show("base");
		
	}
}