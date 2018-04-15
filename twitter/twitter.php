<?php
require_once 'conexionTwitter/TwitterAPIExchange.php';
define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
$TOKEN='449924072-LfvTLKWeVwVGKqDCoISSOrAUDVZx2tSaJjEN6aDe';
$TOKEN_SECRET='cXJLCOaSna7LycPH0TephGBQkYhwuv3h9lCdAqg8c96RU';

// $oauth_tokens = array();
//
$settings = array(
  'oauth_access_token' => $TOKEN,
  'oauth_access_token_secret' => $TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET
);
$url="https://api.twitter.com/1.1/search/tweets.json";
$getfield="?q=as&count=100";
$requestMethod = 'GET';
$url2="https://api.twitter.com/1.1/statuses/show.json";

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
//
// var_dump($response);
//
// $conta=1;
$ids = array();
foreach (json_decode($response)->statuses as $key) {
  // ids.push($key->id);
  $ids[]=$key->id;
  // echo "<h1>".$conta++."</h1>";
  // echo "<h4>".$key->id_str."</h4>";
  // echo "<p>".$key->text."</p>";
  // if($key->geo){
    // echo "<p>".$key->geo."</p>";
  // }else {
    // echo "<h5>Sin geolocalizacion</h5>";
  // }
  // echo "<br/>";
}
// var_dump($ids);
$json=array();
foreach ($ids as $id) {
  $getfield2="?id=".$id;
  $response2 = $twitter->setGetfield($getfield2)
      ->buildOauth($url2, $requestMethod)
      ->performRequest();

  $respuesta=json_decode($response2);
  if (!is_null($respuesta->geo)) {
    json["coordenadas"]=$respuesta;
    // $json.="coordenadas:".$respuesta->geo->coordinates;
  }
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
