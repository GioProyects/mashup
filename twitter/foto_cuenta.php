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


echo json_decode($response)->$profile_background_image_url_https;
// echo json_decode($response);
//object(stdClass)#2 (41) { ["id"]=> int(449924072) ["id_str"]=> string(9) "449924072" ["name"]=> string(13) "oscar geovani" ["screen_name"]=> string(11) "giogow3halo" ["location"]=> string(0) "" ["description"]=> string(0) "" ["url"]=> NULL ["entities"]=> object(stdClass)#3 (1) { ["description"]=> object(stdClass)#4 (1) { ["urls"]=> array(0) { } } } ["protected"]=> bool(false) ["followers_count"]=> int(1) ["friends_count"]=> int(6) ["listed_count"]=> int(0) ["created_at"]=> string(30) "Thu Dec 29 17:19:07 +0000 2011" ["favourites_count"]=> int(0) ["utc_offset"]=> NULL ["time_zone"]=> NULL ["geo_enabled"]=> bool(true) ["verified"]=> bool(false) ["statuses_count"]=> int(0) ["lang"]=> string(2) "es" ["contributors_enabled"]=> bool(false) ["is_translator"]=> bool(false) ["is_translation_enabled"]=> bool(false) ["profile_background_color"]=> string(6) "C0DEED" ["profile_background_image_url"]=> string(48) "http://abs.twimg.com/images/themes/theme1/bg.png" ["profile_background_image_url_https"]=> string(49) "https://abs.twimg.com/images/themes/theme1/bg.png" ["profile_background_tile"]=> bool(false) ["profile_image_url"]=> string(74) "http://pbs.twimg.com/profile_images/982641346514071553/XJF4-0HP_normal.jpg" ["profile_image_url_https"]=> string(75) "https://pbs.twimg.com/profile_images/982641346514071553/XJF4-0HP_normal.jpg" ["profile_link_color"]=> string(6) "1DA1F2" ["profile_sidebar_border_color"]=> string(6) "C0DEED" //["profile_sidebar_fill_color"]=> string(6) "DDEEF6" ["profile_text_color"]=> string(6) "333333" ["profile_use_background_image"]=> bool(true) ["has_extended_profile"]=> bool(false) ["default_profile"]=> bool(true) ["default_profile_image"]=> bool(false) ["following"]=> bool(false) ["follow_request_sent"]=> bool(false) ["notifications"]=> bool(false) ["translator_type"]=> string(4) "none" } 
