# RUST---Donation-Credits
Custom Web application and Oxide plugin for the game Rust.  Allows server owners to host a donation payment portal on their website where players are rewarded in-game based on their payments.

INFORMATION
- Oxide Directory Contains the Oxide Plugin (obviously)
- Web Directory Contains the Web Application (obviously)
- This code contains the PayPal SDK in the Web\includes\paypal\vendor folder.  I simply use this code, I do not claim to own it.
- This code contains the LightOpenID SDK in the Web\includes\lightopenid folder.  I simply use this code, I do not claim to own it.


INSTALLATION


Oxide

Throw the DonateCredits.cs plugin into the your server's oxide/plugins directory. Simple.


Web Application

1. Verify you do not have any conflicting filenames

2. Place the contents of the Web folder into your web server's /public_html/, /www/, or web root folder.

3. Create your databases using the code in the link below

4. Edit the /includes/app_config.php file to add your Steam and PayPal API Keys, and to suit your servers specfic reward needs (This should be the only file you need to edit).

5. Follow the instructions on http://oxidemod.org/plugins/donation-credits.1709/

6. Donate to the developer because you love me.

FAQ & QUESTIONS
- Please read the FAQ on http://oxidemod.org/plugins/donation-credits.1709 
- Post on http://oxidemod.org/threads/donation-credits.16062/ for any specific questions


DEMO

http://donationcredits.palmtree-studios.net/


DONATE

http://oxidemod.org/plugins/donation-credits.1709  =>  "Support the Developer" button.



