<?php

class VoterView extends View
{
	public function renderVoterPage($params, $template)
	{
		$this->data->election = $params->voter->getElection();
		$this->data->username = $params->voter->getVoterId();
		if(!$this->data->styles){
			$this->data->styles = ['layout.css', 'voter.css'];
		}
		else {
			$this->data->styles = array_merge($this->data->styles, ['layout.css','admin.css']);
		}
		
		$this->data->menu = $this->read("voter_menu");
		$this->data->content = $this->read($template);
		$this->data->body = $this->read("main");
		$this->show("base");
	}
}