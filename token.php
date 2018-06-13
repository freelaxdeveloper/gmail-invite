<?php
session_start();
require_once 'vendor/autoload.php';

use App\GoogleContact;

$authCode = isset($_GET["code"]) ? $_GET["code"] : false;

if ($_GET["error"] == 'access_denied'){
	die("Access is denied");
}

//We check whether there is already in the session the previously received token
//If it already exists and the expiration date has not expired - we use it
$getNewToken = true;

if (isset($_SESSION['access_token']) && $_SESSION['access_token_expires']){
	if ($_SESSION['access_token_expires'] > time() ){
		$getNewToken = false;
		$accessToken = $_SESSION['access_token'];
	}
}

//if an authorization code has arrived and the token has not yet been received
if ($authCode && $getNewToken){

	$oauthResponse = GoogleContact::oauth($authCode);

	if( isset($oauthResponse->error) ) {
		die('Authorisation Error');
	}

	//save the received token in the session
	$_SESSION['access_token'] = $oauthResponse->access_token;
  $_SESSION['access_token_expires'] = time() + $oauthResponse->expires_in;
}
header('Location: ./');