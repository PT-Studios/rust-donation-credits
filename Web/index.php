<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/steamLogin.php';

?>

<!DOCTYPE html>
<html lang="en">
    
    <!-- Header -->
    <head>
        
        <?php include 'header.php'; ?>

    </head>

    <!--Body-->
    <body>
        <main>

            <div class="container">

                <div class="row">

                    <div class="column one-third">

                        <h2>Demo</h2>

                        <!-- Message Display -->
                        <p><?php echo $msg ?></p>

                        <!-- The donation form is entirely contained in the file included below, feel free to set up your own html structure and throw it in where you would like -->
                        <?php include 'donate.php'; ?>

                        <!-- Shameless server self-promotion -->
                        <h2>Developed By</h2>
                        <a class="steam-join-hud" target="_blank" href="http://owd.clanservers.com/"></a>
                        <p>If this plugin helped drive your server's donations up, please consider donating to our own.  <br><br>Thank You, <br>OldeTobeh</p>

                    </div>
                    
                </div>

            </div>

        </main>
    </body>
</html>
