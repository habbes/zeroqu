<?php 

$db = Database::getInstance();

$db->beginTransaction();

$tables = ["votes", "voters", "candidates", "positions", "elections", "admins"];

foreach($tables as $table){
	$query = "DROP TABLE IF EXISTS $table";
	$db->exec($query);
}

$query =<<<QUERY

CREATE TABLE admins (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(50) NOT NULL,
	password varchar(255) NOT NULL
)

QUERY;

$db->exec($query);

$query  =<<<QUERY

CREATE TABLE elections (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	title VARCHAR(50) NOT NULL,
	admin_id INT NOT NULL,
	status INT NOT NULL,
	start_date DATETIME,
	end_date DATETIME,
	CONSTRAINT fk_elections
	FOREIGN KEY (admin_id) REFERENCES admins(id)
)

QUERY;

$db->exec($query);

$query  =<<<QUERY

CREATE TABLE voters (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(50),
	voter_id VARCHAR(50) NOT NULL,
	password VARCHAR(255) NOT NULL,
	election_id INT NOT NULL,
	CONSTRAINT fk_voters_elections
	FOREIGN KEY (election_id) REFERENCES elections(id)
)

QUERY;

$db->exec($query);

$query  =<<<QUERY

CREATE TABLE positions (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(50),
	election_id INT NOT NULL,
	CONSTRAINT fk_positions_elections
	FOREIGN KEY (election_id) REFERENCES elections(id)
)

QUERY;

$db->exec($query);

$query  =<<<QUERY

CREATE TABLE candidates (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	description text,
	election_id INT NOT NULL,
	position_id INT NOT NULL,
	CONSTRAINT fk_candidates_elections
	FOREIGN KEY (election_id) REFERENCES elections(id),
	CONSTRAINT fk_candididates_positions
	FOREIGN KEY (position_id) REFERENCES positions(id)
)

QUERY;

$db->exec($query);

$query  =<<<QUERY

CREATE TABLE votes (
	election_id INT NOT NULL,
	position_id INT NOT NULL,
	candidate_id INT NOT NULL,
	voter_id INT NOT NULL,
	PRIMARY KEY (candidate_id, voter_id),
	CONSTRAINT fk_votes_elections
	FOREIGN KEY (election_id) REFERENCES elections(id),
	CONSTRAINT fk_votes_positions
	FOREIGN KEY (position_id) REFERENCES positions(id),
	CONSTRAINT fk_votes_candidates
	FOREIGN KEY (candidate_id) REFERENCES candidates(id),
	CONSTRAINT fk_votes_voters
	FOREIGN KEY (voter_id) REFERENCES voters(id)
)

QUERY;

$db->exec($query);


$db->commit();


?>