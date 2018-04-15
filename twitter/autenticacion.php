<?php
require_once 'TwitterAPIExchange.php';
define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
$TOKEN='449924072-LfvTLKWeVwVGKqDCoISSOrAUDVZx2tSaJjEN6aDe';
$TOKEN_SECRET='cXJLCOaSna7LycPH0TephGBQkYhwuv3h9lCdAqg8c96RU';

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

$porcion=explode("&",$response);
$credenciales = array();
foreach ($porcion as $k) {
  $temp=explode("=",$k);
  $credenciales[$temp[0]]=$temp[1];
}




$TOKEN=$credenciales["oauth_token"];
$TOKEN_SECRET=$credenciales["oauth_token_secret"];
$url2="https://api.twitter.com/oauth/authorize";
$requestMethod2="GET";
$getfield2="?oauth_token=".$credenciales["oauth_token"];

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
