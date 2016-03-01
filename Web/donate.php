<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';
?>

<link rel="stylesheet" href="/css/donate.css">

<div class="payment-container content">
	<h4>Donate</h4>

	<form class="owd-donate-form" action="/includes/paypal/checkout.php" method="post" autocomplete="off">
		<input type="hidden" name="product" value="Donation to OWD Rust Server">
		<label for="amount">
			$
			<input class="donate-price-text" type="number" name="price" value="<?php print $GLOBALS['cfg']['suggestedDonation']; ?>" step="<?php print $GLOBALS['cfg']['rewardConversion']; ?>" min="1">
			.00
		</label>
		<p class="reward-ticker"><span class="value"></span> Shop Credits</p>
		<?php 
			if(isset($_SESSION['T2SteamAuth'])) { 
				echo "<input type='submit' value='Donate'>";
				echo "<p>You will be taken to PayPal to complete your transaction.</p>";
			} else {
				echo $donate;
				echo "<p>Log in to your Steam Account to make a donation.</p>";
			}
		?>
		
	</form>
	<div>
		<?php 
		if(isset($_SESSION['T2SteamAuth']))
			echo $login;
		?>
	</div>
</div>