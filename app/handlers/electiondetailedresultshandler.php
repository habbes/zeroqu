<?php
class ElectionDetailedResultsHandler extends AdminElectionHandler{
	public function get($orgName, $electionName){
		$data = $this->getFinalResults();
		echo "<script> console.log(" . json_encode($data). ");</script>";
		
		$this->viewParams->election = $this->election;
		$this->viewParams->results = $data;
		$this->renderView("DetailedResults");
	}
	public function printFriendly($orgName,$electionName){
		$data = $this->getFinalResults();
		
		$this->viewParams->results = $data;
		$this->viewParams->election = $this->election;
		$this->viewParams->user = $this->admin;
		$this->renderView("PrintResults");
	}
	private function getFinalResults(){
		$data = [];
		$data['positions'] = [];
		foreach ($this->election->getPositions() as $position){
			$pos = ['title'=> $position->getTitle(), 'votes' => $position->countVotes()];
			$pos['candidates'] = [];
			foreach($position->getCandidates() as $candidate){
				$cand = ['name' => $candidate->getName(), 'photo'=> $candidate->getImagePath(), 'votes'=>$candidate->countVotes()];
				$pos['candidates'][] = $cand;
			}
			$data['positions'][] = $pos;
		}
		return $data;
	}
}