<?php
class PrintResultsView extends AdminView{
	public function render($params = null){
		$this->data->menu = null;
		$this->data->results = $params->results;
		$this->data->user = $params->user;
		$this->data->election = $params->election;
		
		$this->renderAdminPage($this->data, "print_election_results");
	}
}