<?php
session_start();
require_once 'vendor/autoload.php';

sleep(mt_rand(1, 3));

$email = $_POST['email'];
$type = $_POST['type'];

echo json_encode([
  'success' => true, 
  'message' => $type == 'invite' ? 'invite sent' : 'request sent'
]);