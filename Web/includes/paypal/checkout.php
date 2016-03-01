<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'app/start.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';

if (!isset($_POST['product'], $_POST['price'])) {
	die();
}

$product = $_POST['product'];
$price = $_POST['price'];
$shipping = 0.00;
$total = $price + $shipping;

//Payer Set
$payer = new Payer();
$payer->setPaymentMethod('paypal');

//Items
$item = new Item();
$item->setName($product)
	->setCurrency('USD')
	->setQuantity(1)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

//Payment Details
$details = new Details();
$details->setShipping($shipping)
	->setSubtotal($price);

//Amount
$amount = new Amount();
$amount->setCurrency('USD')
	->setTotal($total)
	->setDetails($details);

//Transaction
$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription('Donation to Old World Drifters Rust Server.')
	->setInvoiceNumber(uniqid());

//Redirect
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($GLOBALS['cfg']['site_url'] . '/includes/paypal/pay.php?sucess=true&paid='.$price)
	->setCancelUrl($GLOBALS['cfg']['site_url'] . '/includes/paypal/pay.php?sucess=false');

//Payment
$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions([$transaction]);

//Create Payment through Paypal
try {
	$payment->create($paypal);
} catch (Exception $e) {
	echo "<pre>".var_dump($e)."</pre>";
	die($e);
}

//Redirect User
$approvalUrl = $payment->getApprovalLink();
header("Location: {$approvalUrl}");