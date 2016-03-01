<?php

//Start Session
session_start();

//ini_set('display_errors', 1);

//Inc System Files
include $_SERVER["DOCUMENT_ROOT"] . '/includes/mysql/header.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';

//Steam Check
if (!isset($_SESSION['T2SteamUser'])) {
	echo "Something went wrong with your Steam Account Authentication, please Log in to Steam.";
	die();
}

//Check for paid header
if (!isset($_GET['paid'])) {
	echo "Something went wrong with your reward or you're accessing this page out of turn. If you are certian you have made a donation, please contact the server Administrator to claim your reward.";
	die();
} else {
	$paid = $_GET['paid'];
}

//Check for payment token
if (!isset($_SESSION['PayToken'])){

	echo "You are trying to access this page without a proper payment token. Your efforts have been logged and reported to the Administrator.";

	$exploitJson = file_get_contents("logs/Exploiters.json");
	$exploitData = json_decode($exploitJson, true);

	if (isset($exploitData[$_SESSION['T2SteamUser']])) {
		$explCount = $exploitData[$_SESSION['T2SteamUser']];
	} else {
		$explCount = 1;
	}

	$exploitData[$_SESSION['T2SteamUser']] = $explCount;

	$saveExploiters = json_encode($exploitData);

	file_put_contents("logs/Exploiters.json", $saveExploiters);

	die();

} else {
	unset($_SESSION['PayToken']);
}

//$jsonString = file_get_contents("rustserver/server/freewheelCartel/oxide/data/Economics.json");
$jsonString = file_get_contents("logs/Donations.json");
$data = json_decode($jsonString, true);
$rewardVal = $paid/$GLOBALS['cfg']['rewardConversion'];


//Check if steam Id exists, set curval
if (isset($data[$_SESSION['T2SteamUser']])) {
	$currVal = $data[$_SESSION['T2SteamUser']];

} else {
	$currVal = 0;
}

$paidVal = $GLOBALS['cfg']['rewardAmount']*$rewardVal;
$totalReward = $currVal + $paidVal;

//Set reward
$data[$_SESSION['T2SteamUser']] = $totalReward;

$saveJsonString = json_encode($data);

//var_dump($saveJsonString);



file_put_contents("logs/Donations.json", $saveJsonString);

try {
	DonationsAdd($_SESSION['T2SteamID64'],$_SESSION['T2SteamUser'],$paidVal);
} catch(ErrorException $e) {
	echo $e->getMessage();
	die();
}

header("Location: /index.php?msg=THX0MG&amt={$paidVal}&total={$totalReward}");


?>