<?php

class ElectionVotersHandler extends AdminElectionHandler
{
	
	
	private function showPage($view)
	{
		$pageNumber = isset($_GET['page'])?(int)$_GET['page']:1;
		$votersPerPage = 20;
		$offset = ($pageNumber - 1) * $votersPerPage;
		$voters = [];
		$query = "LIMIT ".$votersPerPage." OFFSET ".$offset;
		if(is_null($view)){
			$view = "sent";
		}
			if($view == "sent"){
				$voters = $this->election->getVotersWhere("status=?",[Voter::EMAIL_SENT],$query);
			}else if($view == "failed"){
				$voters = $this->election->getVotersWhere("status=?",[Voter::EMAIL_FAILED],$query);
			}else if($view == "registered"){
				$voters = $this->election->getVotersWhere("status=?",[Voter::REGISTERED],$query);
			}else if($view == "all"){
				$voters = $this->election->getVotersWhere(null,[],$query);
				
			}else{
				
			}
			$paginationUrl = $this->electionUrl . "/voters/" . $view;
			$this->viewParams->currentPageUrl = $paginationUrl . "?page=" . $pageNumber;
			$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . ++$pageNumber;
			if($pageNumber < 1){
			 	$pageNumber = 1;
			}else{
				$pageNumber--;
			}
			
			$this->viewParams->previousPageUrl = $paginationUrl . "?page=" . $pageNumber;
			$this->viewParams->sentCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_SENT]);
			$this->viewParams->failedCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_FAILED]);
			$this->viewParams->registeredCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::REGISTERED]);
			$this->viewParams->allCount = Voter::count("election_id=?",[$this->election->getId()]);
			$this->viewParams->selectedTab = $view;
			$this->viewParams->voters = $voters;
			$this->renderView("ElectionVoters");
		
		
	}
	public function get($org, $election,$view = null)
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
		
		$tokens = [];
		$emails = [];
		if(isset($_FILES) && $_FILES['csv']['size'] !== 0){
			$file = fopen($_FILES['csv']['tmp_name'],'r');
			
			while(!feof($file)){
				$tokens[] = fgetcsv($file);
			}
			foreach($tokens as $group){
				foreach($group as $token){
					if(filter_var($token,FILTER_VALIDATE_EMAIL)){
						$emails[] = $token;
					}else{
						continue;
					}
				}
			}
			fclose($file);
		}
		
		$inputEmails = trim($this->postVar("emails"));
		if(!$inputEmails && empty($emails)){
			$this->viewParams->formResult = "Emails must be provided";
		}
		else {
			$inputEmails = explode("\n", $inputEmails);
			$emails = array_merge($emails,$inputEmails);
			
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