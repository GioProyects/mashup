<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
  require_once 'twitter/TwitterAPIExchange.php';
  define('CONSUMER_KEY', 'IsfOhNHmYtQS5myPZvXB7kqCf');
  define('CONSUMER_SECRET', 'hSe6ZQbao5wEyIvlGFXhA1itlSME9NBhsqOsiKYm5jmOUFJLMx');
  $TOKEN=$_SESSION["oauth_token"];
  $TOKEN_SECRET=$_SESSION["oauth_token_secret"];

  $url="https://api.twitter.com/oauth/access_token";
  $requestMethod="POST";
  $postfields=array(
    "oauth_verifier"=>$_REQUEST["oauth_verifier"]
  );
  $settings = array(
    'oauth_access_token' => $TOKEN,
    'oauth_access_token_secret' => $TOKEN_SECRET,
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET
  );

  $twitter=new TwitterAPIExchange($settings);
  $response3=$twitter->buildOauth($url,$requestMethod)
                    ->setPostfields($postfields)
                    ->performRequest();


  $porcion=explode("&",$response3);
  $credenciales = array();
  foreach ($porcion as $k) {
    $temp=explode("=",$k);
    $credenciales[$temp[0]]=$temp[1];
  }
  $_SESSION["oauth_token"]=$credenciales["oauth_token"];
  $_SESSION["oauth_token_secret"]=$credenciales["oauth_token_secret"];

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
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body class="w3-light-grey w3-content" style="max-width:1600px">

     <!--<div class="container">
       <nav class="navbar navbar-expand-sm navbar-dark bg-faded" style="background:coral;">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <a class="navbar-brand" href="#">Youtube API + Google Maps API + Twitter API</a>

         <div class="collapse navbar-collapse justify-content-end" id="nav-content">
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="cerrar-sesion.php"><img class="rounded-circle" id="fotoPerfil"> Cerrar Sesión</a>
             </li>
          </ul>
        </nav>
        <br>
        <div class="row">
          <div class="col-sm-3 col-sm-3 col-lg-3">

          </div>

        </div>
       <div class="row">
         <div class="col-md-12 col-md-12 col-lg-12">
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
         </div>

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
           <br>
           <div class="row">
             <div class="col-lg-3"></div>
             <div class="col-sm-3 col-md-3 col-lg-3">
               <h5>Pagina: <span id="page"></span></h5>
             </div>
             <div class="col-sm-3 col-md-4 col-lg-4">
               <div id="bloque_paginacion" style="display:none;">
                 <ul class="pagination">
                   <li id="btn_prev" class="page-item"><a class="page-link" >Anterior</a></li>
                   <li id="btn_next" class="page-item"><a class="page-link" >Siguiente</a></li>
                 </ul>

               </div>
             </div>
           </div>
         </div>

         <br>
         <div class="col-lg-6">
           <div id="map"></div>
         </div>
       </div>
     </div>-->

     <!-- Sidebar/menu -->
     <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
       <div class="w3-container">
         <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
           <i class="fa fa-remove"></i>
         </a>
         <!--  agregar imagen-->
         <img id="fotoPerfil" style="width:45%;" class="w3-round"><br><br>
         <h4><b>MASHUP</b></h4>
         <p class="w3-text-grey"></p>
       </div>
       <div class="w3-bar-block">
         <a href="cerrar-sesion.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-twitter w3-hover-opacity w3-margin-right"></i>Cerrar Sesion</a>
       </div>
     </nav>

     <!-- Overlay effect when opening sidebar on small screens -->
     <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

     <!-- !PAGE CONTENT! -->
     <div class="w3-main" style="margin-left:300px">

       <!-- Header -->
       <header id="portfolio">
         <!--  Agregar imagen-->
         <a href="#"><img id="fotoPerfil" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
         <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
         <div class="w3-container">
         <h1><b>Yotube API + Google Maps API + Twitter API</b></h1>
         <div class="w3-section w3-bottombar w3-padding-16">

         </div>
         </div>
       </header>

       <!-- First Photo Grid-->
       <div class="w3-row-padding">
         <div class="w3-third w3-container w3-margin-bottom">
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text">Nombre:</span>
             </div>
             <input id="nomVideo" type="text" class="form-control" placeholder="Ejemplos:love,we,car" aria-label="Amount (rounded to the nearest dollar)" aria-describedby="basic-addon">
           </div>
         </div>

         <div class="w3-third w3-container w3-margin-bottom">
           <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text">Numero</span>
             </div>
             <input id="numVideo" type="text" class="form-control" placeholder="de 100 en adelante" aria-label="Amount (rounded to the nearest dollar)" aria-describedby="basic-addon">
           </div>
         </div>

         <div class="w3-third w3-container">
           <button id="btnBuscar" type="button" class="btn btn-info">Buscar</button>
         </div>
       </div>

       <!-- Images of Me -->
        <div class="w3-row-padding w3-padding-16" id="about">
          <div class="w3-col m6">
            <div class="row" id="results">
            </div>
            <div class="row">
              <div class="w3-col m3">
              </div>
              <div class="w3-col m3">
                <div id="bloque_paginacion" style="display:none;">

                  <ul class="pagination">
                    <li>Pagina: <span id="page"></span></li>
                    <li id="btn_prev" class="page-item"><a class="page-link" >Anterior</a></li>
                    <li id="btn_next" class="page-item"><a class="page-link" >Siguiente</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="w3-col m6">
            <div id="map">

            </div>
          </div>
        </div>

       <!-- final pagina -->
       <div class="w3-black w3-center w3-padding-24">Version 1.0</div>

     <!-- End page content -->
     </div>

     <script>
     // Script to open and close sidebar
     function w3_open() {
         document.getElementById("mySidebar").style.display = "block";
         document.getElementById("myOverlay").style.display = "block";
     }

     function w3_close() {
         document.getElementById("mySidebar").style.display = "none";
         document.getElementById("myOverlay").style.display = "none";
     }
     </script>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


     <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
     <script src="js/youtube.js"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y&libraries=places&callback=funciones.mapa" async defer></script>
   </body>
 </html>
