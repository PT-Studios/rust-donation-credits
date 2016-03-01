<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

session_start();
require 'app/start.php';

//If Not logged in
if(!isset($_SESSION['T2SteamAuth'])) {
    header("Location: /index.php?msg=KNNYL0G");
    die();
}

//If not set AKA error (ADD REDIRECT)
if (!isset($_GET['sucess'], $_GET['paymentId'], $_GET['PayerID'])) {
	echo "Payment Error. Try again later.";
	die();
}

//User cancels or some other wierd thing (ADD REDIRECT)
if ((bool)$_GET['sucess'] === false) {
	echo "Something weird happened or payment was cancelled. Sorry! Please try again later.";
	die();
} else {
	//Set payment session token
	$ptoken = bin2hex(openssl_random_pseudo_bytes(16));
	$_SESSION['PayToken'] = $ptoken;
}


$paid = $_GET['paid'];
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];


$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try {
	$result = $payment->execute($execute, $paypal);
} catch (Exception $e) {
	$data = json_decode($e->getData());
	echo $data->message;
	die();
}

//Sucess action
header("Location: /reward.php?paid={$paid}");