<?php
session_start();
require_once 'TwitterAPIExchange.php';
define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');

$TOKEN=$_SESSION["oauth_token"];
$TOKEN_SECRET=$_SESSION["oauth_token_secret"];

$settings = array(
  'oauth_access_token' => $TOKEN,
  'oauth_access_token_secret' => $TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET
);
$url="https://api.twitter.com/1.1/account/verify_credentials.json";
$requestMethod="GET";
$getfield="";
//$getfield="?q=#".$buscar."&count=100";

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();


echo $response;
 ?>
