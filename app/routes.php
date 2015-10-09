<?php

/**
 * routes mapping url to request handlers
 */
$routes = [
	['^(?:(?:home|index)(?:\.html)?)?\/?$', "Home"],
	['^logout$', "Logout"],
	['^orgs\/([\w\-]+)\/?$', "admin/OrgHome"],
	['^orgs\/([\w\-]+)\/elections\/?$', "admin/OrgHome"],
	['^orgs\/([\w\-]+)\/new\-election\/?$', "admin/NewElection"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/?$', "ElectionHome"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/settings\/?$', "admin/ElectionSettings"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/positions\/?$', "admin/ElectionPositions"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/candidates\/?$' ,"admin/ElectionCandidates"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/candidates\/(\w+)\/image?$' ,"CandidateImage"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/voters\/?$' ,"admin/ElectionVoters"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/voters\/([\w\-]+)\/?$' ,"admin/ElectionVoters"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/view-candidates\/?$',"voter/VoterCandidates"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/vote\/?$',"ElectionHome"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/vote\/([\w\-\s]+)\/?',"voter/VoterVote"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/results\/?$',"ElectionResults"],
	['^orgs\/([\w\-]+)\/elections\/([\w\-]+)\/voter\-login$',"VoterLogin"],
	['^test\/(\d+)\/(\d+)', "OtherTest"],
	['^test\/?$', "Test"],
	
	
];