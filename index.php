<?php
session_start();
require_once 'vendor/autoload.php';

use App\GoogleContact;
use App\Helpers;

if ( empty($_SESSION['access_token']) || $_SESSION['access_token_expires'] < time() ) {

  Helpers::blade('home', ['gmailAuthURL' => GoogleContact::gmailAuthURL()]);
  exit;
  
}

$accessToken = $_SESSION['access_token'];
$contacts = GoogleContact::contacts($accessToken);

Helpers::blade('contacts', compact('contacts'));