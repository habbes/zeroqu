<?php
class DetailedResultsView extends AdminResultsView{
	public function render($params = null){
		$this->data->contentTitle = $params->election->getTitle() . " - Details";
		$this->data->subtitle = $params->election->getTitle() . " - Details";
		$this->renderAdminPage($params, "detailed_election_results");
	}
}