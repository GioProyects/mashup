var funciones = (function() {
  var apiKey = "&key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y";
  var url = [
    "https://www.googleapis.com/youtube/v3/search?",
    "https://www.googleapis.com/youtube/v3/videos?"
  ];
  var current_page = 1;
  var records_per_page = 10;
  var objJson = [];
  var map;

  var buscar = function(nombre, numero, token, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText);
      }
    }
    var temp = url[0].concat("part=id", "&q=", nombre, "&maxResults=", numero, "&pageToken=", token, apiKey);
    xhttp.open("GET", temp, true);
    xhttp.send();
  };

  var infoVideo = function(idVideo, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        json = JSON.parse(this.responseText);
        callback(json);
      }
    };
    var temp = url[1].concat("part=id,recordingDetails", "&id=", idVideo, "&", apiKey);
    xhttp.open("GET", temp, true);
    xhttp.send();
  };

  var buscaTweet = function(nombreTweet, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        callback(JSON.parse(this.responseText));
      }
    };
    xhttp.open("GET", "twitter/twitter.php?q=" + nombreTweet, true);
    xhttp.send();
  };

  function tplawesome(e, t) {
    res = e;
    for (var n = 0; n < t.length; n++) {
      res = res.replace(/\{\{(.*?)\}\}/g, function(e, r) {
        return t[n][r]
      })
    }
    return res
  }

  function prevPage() {
    if (current_page > 1) {
      current_page--;
      changePage(current_page);
    }
  }

  function nextPage() {
    if (current_page < numPages()) {
      current_page++;
      changePage(current_page);
    }
  }

  function numPages() {
    return Math.ceil(objJson.length / records_per_page);
  }

  function changePage(page) {
    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var listing_table = document.getElementById("results");
    var page_span = document.getElementById("page");

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();
    $("#results").html("");

    for (var i = (page - 1) * records_per_page; i < (page * records_per_page) && i < objJson.length; i++) {
      $("#results").append(objJson[i].adName);
      // document.getElementById("results").innerHTML+=objJson[i].adName;
    }
    page_span.innerHTML = page + "/" + numPages();

    if (page == 1) {
      btn_prev.style.visibility = "hidden";
    } else {
      btn_prev.style.visibility = "visible";
    }

    if (page == numPages()) {
      btn_next.style.visibility = "hidden";
    } else {
      btn_next.style.visibility = "visible";
    }
  }

  function initMap() {
    var mapHtml = document.getElementById('map');
    map = new google.maps.Map(mapHtml, {
      center: {
        lat: -34.397,
        lng: 150.644
      },
      zoom:1,
      mapTypeId:"roadmap"
    });
  }

  function ponerMarcas(dicCoordenadas,nombreImagen) {
    var iconBase = 'img/';
    // initMap();
    if (dicCoordenadas.latitude !== undefined && dicCoordenadas.longitude !== undefined) {
      var marker = new google.maps.Marker({
        position: {lat:dicCoordenadas.latitude,lng:dicCoordenadas.longitude},
        map: map,
        icon: iconBase + nombreImagen+".png"
      });
    }
  }

  var main = function() {
    document.getElementById("btnBuscar").addEventListener("click", function() {
      var nomVideo = document.getElementById("nomVideo").value;
      var numVideo = document.getElementById("numVideo").value;
      if (nomVideo == "" || numVideo == "") {
        alert("Algun campo esta vacio");
      } else {
        if (numVideo > 50) {
          var numConsultas = Math.ceil(numVideo / 50);
          var consultaFinal = numVideo % 50;
          var paginaActual = 0;
          var coordenadasVideso = [];
          var infoVideos = [];
          var tokenPage = "";
          let recursivo3 = function() {
            // console.log("Consulta num:" + paginaActual + ", Total consultas:" + numConsultas);
            buscaTweet(nomVideo,function (data) {
              document.getElementById("quitarDiv").style=none;
              if (data.tamanio>0) {
                $.each(data.datos,function (index,item) {
                  ponerMarcas(item,"Twitter");
                  console.log(item);
                });
              }
            });
            if (paginaActual == (numConsultas - 1)) {
              buscar(nomVideo, consultaFinal, tokenPage, function(data) {
                let res = JSON.parse(data);
                res.items.forEach(element => {
                  if (typeof element != 'undefined') {
                    infoVideo(element.id.videoId, function(data) {
                      if (data.items.length > 0) {
                        if (data.items[0].recordingDetails)
                          coordenadasVideso.push(data.items[0].recordingDetails);
                      }
                    });
                  }
                  infoVideos.push(element.id.videoId);
                });
                // poner paginacion videos
                $("#results").html("");
                $.get("reproductor.html", function(result) {
                  $.each(infoVideos, function(index, item) {
                    var html = result;
                    objJson[index] = {
                      adName: tplawesome(html, [{
                        "id_video": item
                      }])
                    };
                  });
                  // document.getElementById("blok_paginacion").style.display = "block";
                  document.getElementById("btn_prev").addEventListener("click", function() {
                    funciones.prevPage();
                  });
                  document.getElementById("btn_next").addEventListener("click", function() {
                    funciones.nextPage();
                  });
                  changePage(1);
                });
                // poner las coordenadas en el mapa
                $.each(coordenadasVideso, function(index, item) {
                  if (item.location !== undefined) {
                      ponerMarcas(item.location,"YouTube");
                  }
                });
              });
            } else {
              buscar(nomVideo, 50, tokenPage, function(data) {
                let res = JSON.parse(data);
                tokenPage = res.nextPageToken
                res.items.forEach(element => {
                  if (typeof element != "undefined") {
                    infoVideo(element.id.videoId, function(datos) {
                      if (datos.items.length > 0) {
                        if (datos.items[0].recordingDetails)
                          coordenadasVideso.push(datos.items[0].recordingDetails);
                      }
                    });
                    infoVideos.push(element.id.videoId);
                  }
                });
                paginaActual += 1;
                recursivo3();
              });
            }
          };
          recursivo3();
        } else {
          buscaTweet(nomVideo,function (data) {
            document.getElementById("quitarDiv").style=none;
            if (data.tamanio>0) {
              $.each(data.datos,function (index,item) {
                ponerMarcas(item,"Twitter");
                console.log(item);
              });
            }
          });
          /*buscar(nomVideo, numVideo, "", function(response) {
            var data = JSON.parse(response);
            $("#results").html("");
            $.get("reproductor.html", function(result) {
              $.each(data.items, function(index, item) {
                var html = result;
                objJson[index] = {
                  adName: tplawesome(html, [{
                    "id_video": item.id.videoId
                  }])
                };
                infoVideo(item.id.videoId, function(data) {
                  if (data.items.length > 0) {
                    if (data.items.recordingDetails !== undefined) {
                      ponerMarcas(map,data.items.recordingDetails,"YouTube.png");
                    }
                  }
                });
              });
              document.getElementById("blok_paginacion").style.display = "block";
              docu*/ment.getElementById("btn_prev").addEventListener("click", function() {
                funciones.prevPage();
              });
              document.getElementById("btn_next").addEventListener("click", function() {
                funciones.nextPage();
              });
              changePage(1);
            });
          });*/
        }
      }
    });
  };

  return {
    main: main,
    prevPage: prevPage,
    nextPage: nextPage,
    mapa: initMap
  };
})();
window.onload = funciones.main;
