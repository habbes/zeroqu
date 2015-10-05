<?php

class ElectionVotersHandler extends AdminElectionHandler
{
	
	
	private function showPage($view)
	{
		$voters = [];
		if(is_null($view)){
			$view = "sent";
		}
			if($view == "sent"){
				foreach($this->election->getVoters() as $voter){
					switch($voter->getStatus()){
						case Voter::EMAIL_SENT:
							$voters[] = $voter;
							break;
					}
				}
			}else if($view == "failed"){
				foreach($this->election->getVoters() as $voter){
					switch($voter->getStatus()){
						case Voter::EMAIL_FAILED:
							$voters[] = $voter;
							break;
					}
				}
			}else if($view == "registered"){
				foreach($this->election->getVoters() as $voter){
					switch($voter->getStatus()){
						case Voter::REGISTERED:
							$voters[] = $voter;
							break;
					}
				}
			}else if($view == "all"){
				$voters = $this->election->getVoters();
			}else{
				
			}
			$this->viewParams->selectedTab = $view;
			$this->viewParams->voters = $voters;
			$this->renderView("ElectionVoters");
		
		
	}
	public function get($election,$view = null)
	{
		$this->showPage($view);
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
		}else if(isset($_POST['selected'])){
			$selected = $_POST['selected'];
			switch($selected){
				case 'all':
					foreach($this->election->getVoters() as $voter){
						if(!$voter->sendEmail(new VoterRegEmailView())){
							$this->viewParams->formResult = "Email not sent";
						}
					}
					break;
				case 'registered':
					foreach($this->election->getVoters() as $voter){
						if($voter->getStatus() == Voter::REGISTERED){
							if(!$voter->sendEmail(new VoterRegEmailView())){
								$this->viewParams->formResult = "Email not sent";
							}
						}
					}
					break;
				case 'sent':
					foreach($this->election->getVoters() as $voter){
						if($voter->getStatus() == Voter::EMAIL_SENT){
							if(!$voter->sendEmail(new VoterRegEmailView())){
								$this->viewParams->formResult = "Email not sent";
							}
						}
					}
					break;
				case 'failed':
					foreach($this->election->getVoters() as $voter){
						if($voter->getStatus() == Voter::EMAIL_FAILED){
							if(!$voter->sendEmail(new VoterRegEmailView())){
								$this->viewParams->formResult = "Email not sent";
							}
						}
					}
					break;
			}
		}
		$view = null;
		$this->showPage($view);
		
	}
	
	public function addVoters()
	{
		
		$emails = trim($this->postVar("emails"));
		
		
		
		if(!$emails){
			$this->viewParams->formResult = "Emails must be provided";
		}
		else {
			$emails = explode("\n", $emails);
			
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