<?php
class ElectionDetailedResultsHandler extends AdminElectionHandler{
	public function get($orgName, $electionName){
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
		echo "<script> console.log(" . json_encode($data). ");</script>";
	}
	
}