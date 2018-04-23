<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
  // echo "$_SESSION[0]";
  // echo "$_SESSION[1]";
  // echo "$_SESSION[2]";
}else {
  echo "<p> Esta pagina es solo para usuarios registrados</p>";
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
       <nav class="navbar navbar-default">
         <div class="navbar-header">
           <a class="navbar-brand"> Youtube API + Google Maps API + Twitter API</a>
         </div>
       </nav>

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
         </div>
       </div>
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
