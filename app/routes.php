<?php

/**
 * routes mapping url to request handlers
 */
$routes = [
	['^(?:(?:home|index)(?:\.html)?)?\/?$', "Home"],
	['^logout$', "Logout"],
	['^new-election$', "admin/NewElection"],
	['^([\w\-]+)\/?$', "ElectionHome"],
	['^([\w\-]+)\/settings\/?$', "admin/ElectionSettings"],
	['^([\w\-]+)\/positions\/?$', "admin/ElectionPositions"],
	['^([\w\-]+)\/candidates\/?$' ,"admin/ElectionCandidates"],
	['^([\w\-]+)\/voters\/?$' ,"admin/ElectionVoters"],
	['^([\w\-]+)\/voters\/([\w\-]+)\/?$' ,"admin/ElectionVoters"],
	['^([\w\-]+)\/view-candidates\/?$',"voter/VoterCandidates"],
	['^([\w\-]+)\/vote\/?$',"ElectionHome"],
	['^([\w\-]+)\/vote\/([\w\-\s]+)\/?',"voter/VoterVote"],
	['^([\w\-]+)\/results\/?$',"ElectionResults"],
	['^([\w\-]+)\/voter\/-login',"VoterLogin"],
	['^test\/(\d+)\/(\d+)', "OtherTest"],
	['^test\/(\w+)', "Test"],
	
	
];