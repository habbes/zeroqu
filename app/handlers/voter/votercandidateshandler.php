<?php

class VoterCandidatesHandler extends VoterHandler
{
	public function get()
	{
		$positions = $this->voter->getAllowedPositions();
		
		$this->viewParams->positions = $positions;
		$this->renderView("VoterCandidates");
	}
}