<?php
	
	//Start session
	session_start();

	//Reward
	if (isset($_GET['amt'])) {
		$reward = $_GET['amt'];
		$totReward = $_GET['total'];
	}

	//Init Config
	$GLOBALS['cfg'] = array();

	#
	# Things you may want to change in a hurry
	#

	$GLOBALS['cfg']['site_url'] = 'http://my.website.com]';
	$GLOBALS['cfg']['site_title'] = 'Donation Credits - Web Application';
	$GLOBALS['cfg']['environment'] = 'sandbox'; //Please use 'sandbox' or 'live' for PayPal environment

	#Paypal Sandbox API Keys (Get yours on developer.paypal.com after registering and creating a REST API Application)
	$GLOBALS['cfg']['sandboxAPIKey'] = 'sandboxAPIKey';
	$GLOBALS['cfg']['sandboxClientId'] = 'sandboxClientId';

	#Paypal Live API Keys (Get yours on developer.paypal.com after registering and creating a REST API Application)
	$GLOBALS['cfg']['liveAPIKey'] = 'liveAPIKey';
	$GLOBALS['cfg']['liveClientId'] = 'liveClientId';

	#Steam API Key (Get your key here https://steamcommunity.com/dev/apikey)
	$GLOBALS['cfg']['steamAPIKey'] = 'steamAPIKey';

	#MySQL Database Info
	$GLOBALS['cfg']['hostname'] = '127.0.0.1';
	$GLOBALS['cfg']['username'] = 'username';
	$GLOBALS['cfg']['password'] = 'password';
	$GLOBALS['cfg']['dbname'] = 'db1234_database';

	#Reward Amount (Economy Credits on server per Reward Conversion below)
	$GLOBALS['cfg']['rewardAmount'] = 160;

	#Reward Conversion (Rewards the player with the defined Reward amount above for Every THIS amount of dollars, eg 160 for every 1 dollar EX: $1.00 = 1)
	$GLOBALS['cfg']['rewardConversion'] = 1;

	#Suggested Donation Amount (Default/Suggested value on the donation form EX: $5.00 = 5)
	$GLOBALS['cfg']['suggestedDonation'] = 5;

	//Messaging Users
	$GLOBALS['cfg']['greetingMsgLoggedIn'] = "Hello {$_SESSION['T2SteamUser']}, you are currently logged in with Steam! To logout click the button to the right. Use the form below to make a donation.";
	$GLOBALS['cfg']['greetingMsgLoggedOut'] = 'Welcome to the Donation Credits web application demo!<br><br>First, configure your website by editting the app_config.php file. Use the form below to test your settings:';
	$GLOBALS['cfg']['donationSucess'] = "<p class='alert'>{$_SESSION['T2SteamUser']}!!<br>Thank you so much for donating!  You have been awarded <span class='highlight-text'>{$reward}</span> Credits towards the server's Blueprint Shop! Connect to the server to claim your reward.</p>";
	$GLOBALS['cfg']['donationNotLoggedIn'] = 'You need to log in to your Steam account before donating.';
