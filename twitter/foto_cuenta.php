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


var_dump(json_decode($response));
// echo json_decode($response);

// string(1304) "{"id":449924072,"id_str":"449924072","name":"oscar geovani","screen_name":"giogow3halo","location":"","description":"","url":null,"entities":{"description":{"urls":[]}},"protected":false,"followers_count":1,"friends_count":6,"listed_count":0,"created_at":"Thu Dec 29 17:19:07 +0000 2011","favourites_count":0,"utc_offset":null,"time_zone":null,"geo_enabled":true,"verified":false,"statuses_count":0,"lang":"es","contributors_enabled":false,"is_translator":false,"is_translation_enabled":false,"profile_background_color":"C0DEED","profile_background_image_url":"http:\/\/abs.twimg.com\/images\/themes\/theme1\/bg.png","profile_background_image_url_https":"https:\/\/abs.twimg.com\/images\/themes\/theme1\/bg.png","profile_background_tile":false,"profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/982641346514071553\/XJF4-0HP_normal.jpg","profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/982641346514071553\/XJF4-0HP_normal.jpg","profile_link_color":"1DA1F2"
//,"profile_sidebar_border_color":"C0DEED","profile_sidebar_fill_color":"DDEEF6","profile_text_color":"333333","profile_use_background_image":true,"has_extended_profile":false,"default_profile":true,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false,"translator_type":"none"}" 
 ?>
