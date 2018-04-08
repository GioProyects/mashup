var funciones = (function() {
  var apiKey = "&key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y";
  var url = ["https://www.googleapis.com/youtube/v3/search?",
    "https://www.googleapis.com/youtube/v3/videos?"
  ];
  var current_page = 1;
  var records_per_page = 10;
  var objJson = [];

  var buscarVideo = function(nombre, numero, token, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText);
      }
    }
    var temp = url[0].concat("part=id,snippet", "&q=", nombre, "&maxResults=", numero, "&pageToken=", token, apiKey);
    xhttp.open("GET", temp, true);
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

  var main = function() {
    document.getElementById("btnBuscar").addEventListener("click", function() {
      var nomVideo = document.getElementById("nomVideo").value;
      var numVideo = document.getElementById("numVideo").value;
      if (nomVideo == "" || numVideo == "") {
        alert("Algun campo esta vacio");
      } else {
        if (numVideo > 50) {


        } else {
          buscarVideo(nomVideo, numVideo, "", function(response) {
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
              });
              document.getElementById("blok_paginacion").style.display = "block";
              document.getElementById("btn_prev").addEventListener("click", function() {
                funciones.prevPage();
              });
              document.getElementById("btn_next").addEventListener("click", function() {
                funciones.nextPage();
              });
              changePage(1);
            });
          });
        }
      }
    });
  };

  return {
    main: main,
    prevPage: prevPage,
    nextPage: nextPage
  };
})();
window.onload = funciones.main;
