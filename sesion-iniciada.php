<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {

}else {
  echo "<p> Esta pagina es solo para usuarios registrados</p>";
  echo "<br/><a href='index.html'> Iniciar Sesion</a>";
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
     <title></title>
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

   </body>
 </html>
