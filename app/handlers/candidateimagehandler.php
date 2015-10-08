<?php

class CandidateImageHandler extends ElectionHandler
{
	public function get($orgName, $electionName, $candidateId)
	{
		$candidate = $this->election->getCandidateById($candidateId);
		if($candidate){
			Utils::sendDataResponse($candidate->getImagePath());
		}
	}
}