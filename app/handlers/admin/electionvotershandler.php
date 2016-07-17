<?php

class ElectionVotersHandler extends AdminElectionHandler
{
	
	
	private function showPage($view)
	{
		$pageNumber = isset($_GET['page'])?(int)$_GET['page']:1;
		$votersPerPage = 5;
		$offset = ($pageNumber - 1) * $votersPerPage;
		$electionProperties = $this->election->getCustomProperties();
		$paginationUrl = $this->electionUrl . "/voters/" . $view;
		$voters = [];
		$query = "LIMIT ".$votersPerPage." OFFSET ".$offset;
		if(is_null($view)){
			$view = "sent";
		}
			if($view == "sent"){
				if(isset($_GET['q'])){
					$niddle = "%{$_GET['q']}%";
					$voters = $this->election->getVotersWhere("status=? AND email LIKE ?",[Voter::EMAIL_SENT,$niddle],$query);
					$this->viewParams->isSearch = true;
					$this->viewParams->niddle = trim($niddle,"%");
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_SENT]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->sentPages = $pages;
				}else{
					$voters = $this->election->getVotersWhere("status=?",[Voter::EMAIL_SENT],$query);
					$this->viewParams->isSearch = false;
					
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_SENT]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->sentPages = $pages;
				}
			}else if($view == "failed"){
				if(isset($_GET['q'])){
					$niddle = "%{$_GET['q']}%";
					$voters = $this->election->getVotersWhere("status=? AND email LIKE ?",[Voter::EMAIL_FAILED,$niddle],$query);
					$this->viewParams->isSearch = true;
					$this->viewParams->niddle = trim($niddle,"%");
					
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_FAILED]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->failedPages = $pages;
				}else{
					$voters = $this->election->getVotersWhere("status=?",[Voter::EMAIL_FAILED],$query);
					$this->viewParams->isSearch = false;
					
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_FAILED]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->failedPages = $pages;
				}
			}else if($view == "registered"){
				if(isset($_GET['q'])){
					$niddle = "%{$_GET['q']}%";
					$voters = $this->election->getVotersWhere("status=? AND email LIKE ?",[Voter::REGISTERED,$niddle],$query);
					$this->viewParams->isSearch = true;
					$this->viewParams->niddle = trim($niddle,"%");
					
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::REGISTERED]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->registeredPages = $pages;
				}else{
					$voters = $this->election->getVotersWhere("status=?",[Voter::REGISTERED],$query);
					$this->viewParams->isSearch = false;
					
					$count = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::REGISTERED]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->registeredPages = $pages;
				}
			}else if($view == "all"){
				if(isset($_GET['q'])){
					$niddle = "%{$_GET['q']}%";
					$voters = $this->election->getVoterWhere("email LIKE ?",[$niddle],$query);
					$this->viewParams->isSearch = true;
					$this->viewParams->niddle = trim($niddle,"%");
					
					$count = Voter::count("election_id=?",[$this->election->getId()]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->allPages = $pages;
				}else{
					$voters = $this->election->getVotersWhere(null,[],$query);
					$this->viewParams->isSearch = false;
					
					$count = Voter::count("election_id=?",[$this->election->getId()]);
					$pages = ceil($count / $votersPerPage);
					$next = $pageNumber + 1;
					if($next > $pages){
						$this->viewParams->theEnd = true;
						$next = $pages;
					}
					$this->viewParams->theEnd = false;
					$this->viewParams->nextPageUrl = $paginationUrl . "?page=" . $next;
					$this->viewParams->alltPages = $pages;
				}
			}else{
				
			}
			
			$this->viewParams->sentCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_SENT]);
			//for pagination
			$this->viewParams->sentPages = ceil($this->viewParams->sentCount / $votersPerPage);
			
			$this->viewParams->failedCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::EMAIL_FAILED]);
			//for pagination
			$this->viewParams->failedPages = ceil($this->viewParams->failedCount / $votersPerPage);
			
			$this->viewParams->registeredCount = Voter::count("election_id=? AND status=?",[$this->election->getId(),Voter::REGISTERED]);
			//for pagination
			$this->viewParams->registeredPages = ceil($this->viewParams->registeredCount / $votersPerPage);
			
			$this->viewParams->allCount = Voter::count("election_id=?",[$this->election->getId()]);
			//for pagination
			$this->viewParams->allPages = ceil($this->viewParams->allCount / $votersPerPage);
			
			$this->viewParams->selectedTab = $view;
			$this->viewParams->voters = $voters;
			$this->viewParams->electionProperties = $electionProperties;
			
			//page numbers ================================================================================================	
				
			$previousPage = $pageNumber - 1;
			if($previousPage < 1)
				$previousPage = 1;
				
			$this->viewParams->previousPageUrl = $paginationUrl . "?page=" . $previousPage;
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
			$inputProperties = $_POST;
			unset($inputProperties["emails"]);
			unset($inputProperties["add"]);
			
			$emails = array_merge($emails,$inputEmails);
			
			$emailView = new VoterRegEmailView();
			$this->election->addVoters($emails, $inputProperties, $emailView);
		}
		
		
	}
	
	public function resendEmail()
	{
		$id = (int) $this->postVar("id");
		
		$email = trim($this->postVar("email"));
		$voter = $this->election->getVoterById($id);
		$holder = $_POST;
		//remove the id and the email
		unset($holder["id"]);
		unset($holder["email"]);
		
		//This will updatte the customValue values;
		foreach($holder as $key=>$value){
			$customValue = CustomValue::findById($key);
			if($customValue){
				$customValue->setValue($value);
				$customValue->save();
			}
		}
		if(!$voter){
			$this->viewParams->formResult = "Voter not found";
			return;
		}
		
		if($email != $voter->getEmail()){
			$voter->setEmail($email);
		}
		$properties = $this->election->getCustomProperties();
		if($properties){
			foreach($properties as $property){
				
			}
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
		foreach ($voter->getAllCustomValues() as $value){
			$value->delete();
		}
		if(!$voter->delete()){
			$this->viewParams = "Voter not unregistered";
		}
	}
}