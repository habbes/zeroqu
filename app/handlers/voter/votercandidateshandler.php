<?php

class VoterCandidatesHandler extends VoterHandler
{
	public function get()
	{
		$positions = $this->election->getPositions();
		
		$this->viewParams->positions = $positions;
		$this->renderView("VoterCandidates");
	}
}