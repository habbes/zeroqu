<?php

class ElectionVotersHandler extends AdminElectionHandler
{
	
	
	private function showPage()
	{
		$this->viewParams->voters = $this->election->getVoters();
		$this->renderView("ElectionVoters");
	}
	public function get()
	{
		$this->showPage();
	}
	
	public function post()
	{
		if(isset($_POST['add'])){
			$this->addVoters();
		}
		else if(isset($_POST['resend'])){
			$this->resendEmail();
		}
		else if(isset($_POST['delete'])){
			$this->deleteVoter();
		}
		$this->showPage();
		
	}
	
	public function addVoters()
	{
		$prefix = trim($this->postVar("prefix"));
		
		$emails = trim($this->postVar("emails"));
		
		
		
		if(!$emails){
			$this->viewParams->formResult = "Emails must be provided";
		}
		else {
			$emails = explode("\n", $emails);
			if(!$this->election->getPrefix()){
				$this->election->setPrefix($prefix);
			}
			
			
			
			$emailView = new VoterRegEmailView();
			$this->election->addVoters($emails, $emailView);
		}
		
		
		
	}
	
	public function resendEmail()
	{
		$id = (int) $this->postVar("id");
		
		$email = trim($this->postVar("email"));
		
		$voter = $this->election->getVoterById($id);
		
		if(!$voter){
			$this->viewParams->formResult = "Voter not found";
			return;
		}
		
		if($email != $voter->getEmail()){
			$voter->setEmail($email);
		}
		
		if(!$voter->sendEmail(new VoterRegEmailView())){
			$this->viewParams->formResult = "Email not sent";
		}
	}
	
	public function deleteVoter()
	{
		$id = (int) $this->postVar("id");
		$voter = $this->election->getVoterById($id);
		if(!$voter){
			$this->viewParams->formResult = "Voter not found";
		}
		
		if(!$voter->delete()){
			$this->viewParams = "Voter not unregistered";
		}
	}
}