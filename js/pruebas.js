var consulta = (function () {
    var apiKey = "key=AIzaSyDpWaTwg13YO51k3w_J-4fwjwObpbjDe4Y";
    var url = ["https://www.googleapis.com/youtube/v3/search?",
               "https://www.googleapis.com/youtube/v3/videos?"];

    var buscar = function (nombre, numero, token, callback,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              json = JSON.parse(this.responseText);
              callback(json);
            }else{
              error(this.statusText);
            }
        };
        var temp = url[0].concat("part=id", "&q=", nombre, "&pageToken=", token, "&maxResults=", numero,"&regionCode=us", "&", apiKey);
        xhttp.open("GET", temp, true);
        xhttp.send();
    };

    var infoVideo = function (idVideo, callback,error) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          json = JSON.parse(this.responseText);
          callback(json);
        }else {
          error(this.statusText);
        }
      };
      var temp = url[1].concat("part=recordingDetails,contentDetails", "&id=", idVideo, "&", apiKey);
      xhttp.open("GET", temp, true);
      xhttp.send();
    };

    var main = function () {
        var nombre = document.getElementById("inpNomVideo");
        var numero = document.getElementById("inpNumVideo");

        if (numero.value > 50) {
            var numConsultas = Math.ceil(numero.value / 50);
            var consultaFinal = numero.value % 50;
            var tokenPage = "";
            var ids = [];
            var tokensPaginas = [];
            var paginaActual = 0;
            var infoVideos=[];

            let recursivo1 = function () {
                // SI FUNCIONA FORMA 1******************************************************
                if (ids.length < numero.value) {
                    buscar(nombre.value, 50, tokenPage, function (data) {
                        tokenPage = data.nextPageToken;
                        tokensPaginas.push(tokenPage);
                        data.items.forEach(element => {
                            ids.push(element.id.videoId);
                        });
                        // consultaActual++;
                        recursivo1();
                    })
                }
                // SI FUNCIONA FORMA 1******************************************************
            }
            // recursivo2();
            var recursivo3=function(){
              console.log("Numero de consulta:"+paginaActual+", numConsultas:"+numConsultas);
              if (paginaActual == (numConsultas-1)) {
                buscar(nombre.value,consultaFinal,tokenPage,function (data) {
                  data.items.forEach(element=>{
                    if (typeof element != 'undefined') {
                      infoVideo(element.id.videoId,function (data) {
                        if (data.items.length>0) {
                          if(data.items[0].recordingDetails)
                            infoVideos.push(data.items[0].recordingDetails);
                        }
                      },function (error) {
                        console.log(error+" en infovideo final");
                      });
                    }
                  });
                },function (error) {
                  console.log(error+" en final buscar");
                });
                // console.log(infoVideos);
              } else {
                buscar(nombre.value,50,tokenPage,function (data) {
                  tokenPage=data.nextPageToken;
                  data.items.forEach(element => {
                    if (typeof element != "undefined") {
                      infoVideo(element.id.videoId,function (data) {
                        if (data.items.length >0) {
                          if(data.items[0].recordingDetails)
                            infoVideos.push(data.items[0].recordingDetails);
                        }
                      },function (error) {
                        console.log(error+" error con infovideo recursivo");
                      });
                    }
                  });
                  paginaActual+=1;
                  recursivo3();
                },function (error) {
                  console.log(error+" en buscar recursivo");
                });
              }
            };


            recursivo3();
            console.log(infoVideos);
        } else {
            buscar(nombre.value, numero.value, function (data) {
                console.log(data);
            },function (data) {
              console.log(data);
            },function (error) {

            });
        }
    }

    return {
        main: main
    }
})();

document.getElementById("btnBuscar").addEventListener("click", consulta.main);





/*
let studens = [
    { name: "Oscar", score: 100, school: "East" },
    { name: "Paola", score: 67, school: "East" },
    { name: "Marcos", score: 97, school: "West" },
    { name: "Ginna", score: 43, school: "West" },
    { name: "Yadira", score: 23, school: "East" },
    { name: "Oscar", score: 21, school: "East" },
    { name: "Paola", score: 67, school: "East" },
    { name: "Marcos", score: 34, school: "West" },
    { name: "Ginna", score: 76, school: "West" },
    { name: "Yadira", score: 34, school: "East" }
];

let processStudent = function (data, callback) {
    for (var i = 0; i < data.length; i++) {
        if (data[i].school.toLowerCase() === "east") {
            if (typeof callback === "function") {
                callback(data[i]);
            }
        }
    }
};

processStudent(studens, function (obj) {
    if (obj.score < 50) {
        console.log(obj.name + "passed");
    }
});

let determineTotal = function () {
    let total = 0,
        count = 0;

    processStudent(studens, function (obj) {
        total += obj.score;
        count++;
    });

    console.log("total score:" + total + "- total count:" + count);

};

determineTotal();
*/
