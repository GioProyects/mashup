<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
  // require_once 'twitter/TwitterAPIExchange.php';
  // define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
  // define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
  // $TOKEN=$_SESSION["oauth_token"];
  // $TOKEN_SECRET=$_SESSION["oauth_token_secret"];
  //
  // $url="https://api.twitter.com/oauth/access_token";
  // $requestMethod="POST";
  // $postfields=array(
  //   "oauth_verifier"=>$_REQUEST["oauth_verifier"]
  // );
  // $settings = array(
  //   'oauth_access_token' => $TOKEN,
  //   'oauth_access_token_secret' => $TOKEN_SECRET,
  //   'consumer_key' => CONSUMER_KEY,
  //   'consumer_secret' => CONSUMER_SECRET
  // );
  //
  // $twitter=new TwitterAPIExchange($settings);
  // $response3=$twitter->buildOauth($url,$requestMethod)
  //                   ->setPostfields($postfields)
  //                   ->performRequest();
  //
  //
  // $porcion=explode("&",$response3);
  // $credenciales = array();
  // foreach ($porcion as $k) {
  //   $temp=explode("=",$k);
  //   $credenciales[$temp[0]]=$temp[1];
  // }
  // $TOKEN=$credenciales["oauth_token"];
  // $TOKEN_SECRET=$credenciales["oauth_token_secret"];

  
  //"oauth_token=449924072-wLFORhlA94XcTTYJzWW9vnG4kN7TMBPkCAfgZKWi&
  //oauth_token_secret=U5IAJAoLbzlzPLR98pHWyi137Y44S1LyV1F2LOYsWg8oi&
  //user_id=449924072&screen_name=giogow3halo"
}else {
  //echo "<p> Esta pagina es solo para usuarios registrados</p>";
  echo '<div class="alert alert-warning" role="alert">Necesita iniciar sesion para ver esta pagina</div>';
  echo "<br/><a href='index.php'> Iniciar Sesion</a>";
  exit;
}
 ?>

 <!DOCTYPE html>
 <html>
 <html lang="es">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Mashup</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
     <link rel="stylesheet" href="css/estilos.css">
   </head>
   <body>

     <div class="container">
       <!-- <nav class="navbar navbar-expand-sm navbar-dark bg-faded">
         <div class="navbar-header">
           <a class="navbar-brand"> Youtube API + Google Maps API + Twitter API</a>
         </div>
         <ul class="nav navbar-nav navbar-right">
           <div style="font-size:2em; color:DodgerBlue">
             <i class="fab fa-twitter"></i>
             <a href="cerrar-sesion.php">Cerrar sesión</a>
           </div>
         </ul>
       </nav> -->

       <nav class="navbar navbar-expand-sm navbar-dark bg-faded" style="background:coral;">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <!-- Brand -->
         <img class="rounded-circle" id="fotoPerfil">
         <a class="navbar-brand" href="#">Youtube API + Google Maps API + Twitter API</a>
         <!-- Links -->
         <div class="collapse navbar-collapse justify-content-end" id="nav-content">
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="cerrar-sesion.php">Cerrar Sesión</a>
             </li>
          </ul>
        </nav>
        <br>
        <div class="row">
          <div class="col-sm-3 col-sm-3 col-lg-3">

          </div>

        </div>
       <div class="row">
         <!--<div class="col-md-12 col-md-12 col-lg-12">
           <form>
             <div class="form-group">
               <label for="usr">Nombre:</label>
               <input type="text" class="form-control" id="nomVideo" placeholder="Ejem:love,we,car">
             </div>
             <div class="form-group">
               <label for="pwd">Numero de videos:</label>
               <input type="number" class="form-control" id="numVideo" placeholder="Mas seguro poner arriba de los 100">
             </div>
             <button id="btnBuscar" type="button" class="btn btn-danger">Buscar</button>
           </form>
         </div>-->
         <!-- <div class="col-md-12 col-md-12 col-lg-12">
           <div class="input-group-prepend">
             <span class="input-group-text">Nombre:</span>
           </div>
           <input type="text" class="form-control" id="nomVideo" placeholder="Ejem:love,we,car" aria-label="Amount (rounded to the nearest dollar)" aria-describedby="basic-addon">
         </div> -->

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Nombre:</span>
          </div>
          <input type="text" id="nomVideo" class="form-control" placeholder="Ejem:love,we,car" aria-label="Amount (rounded to the nearest dollar)" aria-describedby="basic-addon">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Numero</span>
          </div>
          <input type="number" id="numVideo" class="form-control" placeholder="Mas seguro poner arriba de los 100" aria-label="Amount (rounded to the nearest dollar)" aria-describedby="basic-addon">
        </div>

        <button id="btnBuscar" type="button" class="btn btn-danger">Buscar</button>
       </div>
       <br>
       <div class="row">
         <div class="col-lg-6">
           <div class="row" id="results">
           </div>
           <div class="row">
             <div class="col-lg-3"></div>
             <div class="col-lg-4">
               <div id="bloque_paginacion" style="display:none;">
                 <ul class="pagination">
                   <li id="btn_prev" class="page-item"><a class="page-link" >Anterior</a></li>
                   <li id="btn_next" class="page-item"><a class="page-link" >Siguiente</a></li>
                 </ul>
                 <h5>Pagina: <span id="page"></span></h5>
               </div>
             </div>
           </div>
         </div>

         <br>
         <div class="col-lg-6">
           <div id="map"></div>
         </div>
       </div>
     </div>

     <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
     <script src="js/youtube.js"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y&libraries=places&callback=funciones.mapa" async defer></script>
   </body>
 </html>
