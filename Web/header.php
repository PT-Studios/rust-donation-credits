
<!-- Header -->


<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';

?>

<meta charset="UTF-8">
<title><?php print $GLOBALS['cfg']['site_title'] ?></title>

<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="icon" sizes="16x16 32x32" href="/favicon.ico">
<link rel="stylesheet" href="/css/main.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">

    $(window).load(function() {
        console.log("Web Donation Credits loaded!");

        <?php

            echo "var phpReward = '{$GLOBALS['cfg']['rewardAmount']}';";
            echo "var phpConversion = '{$GLOBALS['cfg']['rewardConversion']}';";

        ?>

        console.log('Donation reward set to '+ phpReward +' per $'+phpConversion+'.00 donated.  Change this in the /includes/app_config file.');

        //Calculate donation reward
        function calcReward (phpreward, phpconv) {
            var value = parseInt($(".donate-price-text").val());
            var number = Math.floor(value / phpconv) * phpconv;
            var rewardPts = (number/phpconv) * phpreward;
            if (rewardPts == 0 && value == 1) {
                //rewardPts = 160;
            }
            if (rewardPts == 0 && value >= 2) {
                //rewardPts = 200;
            }
            $( ".reward-ticker .value" ).empty();
            $( ".reward-ticker .value" ).append( rewardPts );
            $( ".reward-ticker" ).show();
        }

        $(".donate-price-text").bind('keyup mouseup', function () {
            calcReward(phpReward,phpConversion);
        });

        //Alert blink
        $(".alert").fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);

        //On load Calculate
        calcReward(phpReward,phpConversion);
    });


    $( document ).ready(function() {
        console.log( "Web Donation Credits ready!" );
    });


</script>