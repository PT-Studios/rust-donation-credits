<?php

// Make a MySQL Connection
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/mysql/config/config.php';

//Add/Update Donation
function DonationsAdd($steamId, $username, $amount){
	$dbConn = new ConnDB();
	$dbConn->query("CALL DonationsAdd(:steam_id, :username, :amount)");
	$dbConn->bind(':steam_id', $steamId);
	$dbConn->bind(':username', $username);
	$dbConn->bind(':amount', $amount);
	$dbConn->execute();
}

?>