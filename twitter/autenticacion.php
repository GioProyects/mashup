<?php
session_start();
require_once 'TwitterAPIExchange.php';
define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
$TOKEN='449924072-LrNEFXwN0UOaMjY0GTiwWe2lgGGWwOWyvjp7kfZl';
$TOKEN_SECRET='LlVQ0mpXVAuNroP72q5rybvyJDKY6RgIrAqiHK2lM1LLl';

$settings = array(
  'oauth_access_token' => $TOKEN,
  'oauth_access_token_secret' => $TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET
);

$url="https://api.twitter.com/oauth/request_token";
$requestMethod="POST";
$postfields=array(
);

$twitter=new TwitterAPIExchange($settings);
$response=$twitter->buildOauth($url,$requestMethod)
                  ->setPostfields($postfields)
                  ->performRequest();
// var_dump($response);
$porcion=explode("&",$response);
$credenciales = array();
foreach ($porcion as $k) {
  $temp=explode("=",$k);
  $credenciales[$temp[0]]=$temp[1];
}
//
$TOKEN=$credenciales["oauth_token"];
$TOKEN_SECRET=$credenciales["oauth_token_secret"];
//
$_SESSION["oauth_token"]=$credenciales["oauth_token"];
$_SESSION["oauth_token_secret"]=$credenciales["oauth_token_secret"];
$_SESSION["loggedin"]=$credenciales["oauth_callback_confirmed"];
//
$url2="https://api.twitter.com/oauth/authorize";
$requestMethod2="GET";
$getfield2="?oauth_token=".$TOKEN;

$settings = array(
  'oauth_access_token' => $TOKEN,
  'oauth_access_token_secret' => $TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET
);

$twitter=new TwitterAPIExchange($settings);
$response2 = $twitter->setGetfield($getfield2)
    ->buildOauth($url2, $requestMethod2)
    ->performRequest();

echo $response2;

// var_dump($response2);

// array(3) {
//    ["oauth_token"]=> string(27) "a2vYlgAAAAAA5csJAAABYvDAIpw"
//    ["oauth_token_secret"]=> string(32) "6yGOsX3R56JN0pDfMTmKMkf9uf9kemI2"
//    ["oauth_callback_confirmed"]=> string(4) "true"
//  }
