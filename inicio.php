<?php
require_once 'TwitterAPIExchange.php';


define('CONSUMER_KEY', 'C1nBfLAMVtIMuJ09g5uMYLh8T');
define('CONSUMER_SECRET', 'Qgma3VAu5miBNWtivf5igPEGnZ9JyR0XlF0Z1Re1gii8KE6Nc1');
define('TOKEN', '976707907961094144-HAxQodBwUEgRQvKfDViPlf8sOgLERWP');
define('TOKEN_SECRET', '4aQyLUHKSTL2KMD6FENwwOlLvKF4It5wmEB3AQGbGTbx7');


$settings = array(
  'oauth_access_token' => TOKEN,
  'oauth_access_token_secret' => TOKEN_SECRET,
  'consumer_key' => CONSUMER_KEY,
  'consumer_secret' => CONSUMER_SECRET);


  // $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
  // $url="https://api.twitter.com/1.1/users/search.json";
  $url="https://api.twitter.com/1.1/account/verify_credentials.json";
  // $getfield = '?screen_name=oscarge51015813';
  // $getfield="";
  $requestMethod = 'GET';

  $twitter = new TwitterAPIExchange($settings);
  $response = $twitter->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest();

  // foreach (json_decode($response) as $key) {
  //   echo "<div>";
    // echo "<img src='".$key->profile_image_url."'>";
    // echo "<p>Nombre:<strong>".$key->name."</strong></p>";
    // echo "<p>Screen name:<h3>".$key->screen_name."</h3></p>";
    // echo "<p>Descripcion:<h4>".$key->description."<h4></p>";
    // echo "<p>Geolocalizacion:".$key->geo_enabled."</p>";
    // echo "<p>".$key->screen_name."</p>";
    // echo "<img src=".$key->profile_image_url.">";
    // echo "<p>".$key->followers_count."</p>";

  //   echo "</div>";
  // }

  var_dump($response);
