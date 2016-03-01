<?php

require 'includes/lightopenid/openid.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';

$_STEAMAPI = $GLOBALS['cfg']['steamAPIKey'];

session_start();

try 
{
    $openid = new LightOpenID($GLOBALS['cfg']['site_url']);

    if(!$openid->mode) 
    {
        if(isset($_GET['login'])) 
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
        } elseif(!isset($_SESSION['T2SteamAuth'])) {
            $login = "<a class='login-block' href=\"?login\"><img src=\"https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_large_noborder.png\"/></a>";
            $donate = "<a href=\"?login\"><img src=\"https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png\"/></a>";
        }
    } 
    elseif($openid->mode == 'cancel') 
    {
        echo 'User has canceled authentication!';
    } 
    else 
    {

        if(!isset($_SESSION['T2SteamAuth'])) 
        {
            $_SESSION['T2SteamAuth'] = $openid->validate() ? $openid->identity : null;
            $_SESSION['T2SteamID64'] = str_replace("http://steamcommunity.com/openid/id/", "", $_SESSION['T2SteamAuth']);

            if($_SESSION['T2SteamAuth'] !== null){

                $Steam64 = str_replace("http://steamcommunity.com/openid/id/", "", $_SESSION['T2SteamAuth']);
                $profile = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$_STEAMAPI}&steamids={$Steam64}");
                $buffer = fopen("cache/{$Steam64}.json", "w+");
                fwrite($buffer, $profile);
                fclose($buffer);

            }

            header("Location: index.php");

        }

    }

    //Page Display after login
    if(isset($_SESSION['T2SteamID64'])){

        $steam = json_decode(file_get_contents("cache/{$_SESSION['T2SteamID64']}.json"));
        $user = $steam->response->players[0];
        if(!isset($_SESSION['T2SteamUser'])) {
            $_SESSION['T2SteamUser'] = $user->personaname;
        }
        //print_r($user);
        //echo $user->personaname;
        //echo "<img src=\"{$user->avatarfull}\"/>";
        $login = "<a class='login-block logged-in' href=\"?logout\"><span class='user-name'>{$user->personaname}</span><span class='logout-msg'>logout</span><img class='ava' src=\"{$user->avatar}\"/></a>";
    }

    //Logout
    if(isset($_GET['logout'])){

        unset($_SESSION['T2SteamAuth']);
        unset($_SESSION['T2SteamID64']);
        unset($_SESSION['T2SteamUser']);
        header("Location: index.php");

    }

    //Messages
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'THX0MG') {
            $msg = $GLOBALS['cfg']['donationSucess'];
        } elseif ($_GET['msg'] == 'KNNYL0G') {
            $msg = $GLOBALS['cfg']['donationNotLoggedIn'];
        } else {
            $msg = $GLOBALS['cfg']['greetingMsgLoggedIn'];
        }
    } else {
        if(isset($_SESSION['T2SteamID64'])){
            $msg = $GLOBALS['cfg']['greetingMsgLoggedIn'];
        } else {
            $msg = $GLOBALS['cfg']['greetingMsgLoggedOut'];
        }
    }



} 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}