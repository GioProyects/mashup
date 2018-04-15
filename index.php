<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
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
      <ul class="nav navbar-nav navbar-right">
        <div style="font-size:2em; color:DodgerBlue">
          <i class="fab fa-twitter"></i>
          <a href="twitter/autenticacion.php">Iniciar sesión</a>
        </div>
      </ul>
    </nav>

    <?php if(isset($_SESSION)){ ?>
    <div class="row">
      <div class="col-md-12 col-md-12 col-lg-12">
        <form>
          <div class="form-group">
            <label for="usr">Nombre:</label>
            <input type="text" class="form-control" id="nomVideo" placeholder="Ejem:love,we,car">
          </div>
          <div class="form-group">
            <label for="pwd">Numero de videos:</label>
            <input type="number" class="form-control" id="numVideo">
          </div>
          <button id="btnBuscar" type="button" class="btn btn-danger">Buscar</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="row" id="results">
          <div id="blok_paginacion" class="col-lg-6" style="display:none;">
            <ul class="pagination">
              <li id="btn_prev" class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li id="btn_next" class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
            <h5>Pagina: <span id="page"></span></h5>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div id="map"></div>
      </div>
    </div>

    <?php }else{ ?>
    <h3>Inicia sesion</h3>
    <?php } ?>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/youtube.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y&libraries=places&callback=funciones.mapa" async defer></script>
</body>

</html>






<!--

<!DOCTYPE html>
<html>
  <head>
    <title>Custom Markers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: new google.maps.LatLng(-33.91722, 151.23064),
          mapTypeId: 'roadmap'
        });

        var iconBase = 'img/';
        var icons = {
          parking: {
            icon: iconBase + 'Twitter.png'
          },
          library: {
            icon: iconBase + 'YouTube.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(-33.91721, 151.22630),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91539, 151.22820),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91747, 151.22912),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91910, 151.22907),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91725, 151.23011),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91872, 151.23089),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91784, 151.23094),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91682, 151.23149),
            type: 'library'
          }, {
            position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
            type: 'library'
          }
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y&callback=initMap">
    </script>
  </body>
</html> -->
