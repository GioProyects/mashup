<?php
require_once 'twitter/TwitterAPIExchange.php';
define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
$TOKEN='449924072-LfvTLKWeVwVGKqDCoISSOrAUDVZx2tSaJjEN6aDe';
$TOKEN_SECRET='cXJLCOaSna7LycPH0TephGBQkYhwuv3h9lCdAqg8c96RU';

// $oauth_tokens = array();
$buscar=$_REQUEST['q'];

$settings = array(
  'oauth_access_token' => $TOKEN,
  'oauth_access_token_secret' => $TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET
);
$url="https://api.twitter.com/1.1/search/tweets.json";
$getfield="?q=".$buscar."&count=100";
$requestMethod = 'GET';
$url2="https://api.twitter.com/1.1/statuses/show.json";

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$ids = array();
foreach (json_decode($response)->statuses as $key) {
  $ids[]=$key->id;
}

$json=array();
foreach ($ids as $id) {
  $getfield2="?id=".$id;
  $response2 = $twitter->setGetfield($getfield2)
      ->buildOauth($url2, $requestMethod)
      ->performRequest();

  $respuesta=json_decode($response2);
  $json["texto"]=$respuesta->text;
  // if (!is_null($respuesta->coordinates)) {
  //   $json["coordenadas"]=$respuesta->coordinates;
  // }
}
echo json_encode($json);
// ###################################################################################
// 984550821198254080
// 984550812633501699
// 984550793012547586



// $getfield ="?oauth_token=".$oauth_tokens['oauth_token'];

//
// $TOKEN="".$oauth_tokens["oauth_token"];
// $TOKEN_SECRET="".$oauth_tokens["oauth_token_secret"];
//
// $settings = array(
//   'oauth_access_token' => $TOKEN,
//   'oauth_access_token_secret' => $TOKEN_SECRET,
//   'consumer_key' => CONSUMER_KEY,
//   'consumer_secret' => CONSUMER_SECRET
// );
//
// $twitter = new TwitterAPIExchange($settings);
// $response2 = $twitter->setGetfield($getfield)
//     ->buildOauth($url, $requestMethod)
//     ->performRequest();
//
// var_dump($response2);
