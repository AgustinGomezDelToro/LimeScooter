<?php
session_start();

if(empty($_SESSION)){
  header("location:../index.php");
}

include "../controllers/Token.php";
include("../models/userModel.php");
$user_details = $userModel->get_details();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>EASYSCOOTER </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../adminDash/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../adminDash/assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />


  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <style>
    #map {
      height: 680px;
    }
  </style>
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <?php
    include("left_bar.php");
    ?>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php
    include("header.php");
    ?>
    <div class="container-fluid py-4">
      <?php
      include("botonera.php");
      ?>
    

      <div class="row mt-4">

        <div class="col" id="display_res" style="display:none">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Scooters for rent</h6>
            </div>
            <div class="card-body p-3">
              <h3>Votre location est en cours et votre temps de trajet est de :<label id="minutes">00</label>:<label id="seconds">00</label></h3>
              <input type="hidden" id="reservation_id">
              <button id="stop_reservation_btn" class="btn btn-primary">Returner Scooter</button>
            </div>
          </div>
        </div>


        <div class="col" id="display_map" style="display:none">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Scooters for rent</h6>
            </div>
            <div class="card-body p-3">
              <div id="map"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="modal" tabindex="-1" id="modal_reserve">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Louer un scooter <span id="monopatin_id"></span></h5>
            <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Km parcourus: <span id="scooter_km"></span></p>
            <p>% batterie actuel: <span id="scooter_bat"></span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="modal_reserve">Fermer</button>
            <form method="POST" action="reservation.php">
              <input type="hidden" id="scooter_id" name="scooter_id">
              <button class="btn btn-primary" id="confirm_reservation">Louer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer pt-3 ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start"> ©
              <script>
                document.write(new Date().getFullYear())
              </script>, by Easyscooters</a>
            </div>
          </div>
          
        </div>
      </div>
    </footer>
  </main>
  <input type="hidden" id="user_id_input" value="<?php echo $_SESSION['userId']; ?>">
  <!--   Core JS Files   -->
  <script src="../../view/assets/js/core/popper.min.js"></script>
  <script src="../../view/assets/js/core/bootstrap.min.js"></script>



  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../adminDash/assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
  <script>
    $(document).ready(function() {


      
      var userId = $("#user_id_input").val()

      check_reservation(userId)

      function start_timer(seconds) {
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var totalSeconds = seconds;
        setInterval(setTime, 1000);



        function setTime() {
          ++totalSeconds;
          secondsLabel.innerHTML = "<h3>" + pad(totalSeconds % 60) + "</h3>";
          minutesLabel.innerHTML = "<h3>" + pad(parseInt(totalSeconds / 60)) + "</h3>";
        }

        function pad(val) {
          var valString = val + "";
          if (valString.length < 2) {
            return "0" + valString;
          } else {
            return valString;
          }
        }
      }

      function check_reservation(userId) {

        var data = {
          userId: userId
        }

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "mapping/check_reservation.php",
          data: data
        }).done(function(rsp) {
          if (rsp.seconds) {
            $("#display_res").css('display', 'block')
            $("#display_map").css('display', 'none')
            $("#reservation_id").val(rsp.idRide)
            start_timer(parseInt(rsp.seconds))
          } else {
            $("#display_res").css('display', 'none')
            $("#display_map").css('display', 'block')
            setTimeout(function(){ map.invalidateSize(true)}, 400);
          }

          
        });
      }


      var map = L.map('map').setView([45.75580771887143, 4.835828819141278], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
      }).addTo(map);
      var markers = [];
      var route = L.featureGroup();
      var data = {
        scooter: 0
      }
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "../mapping/mapping_functions.php",
        data: data
      }).done(function(rsp) {
        rsp.forEach(function(obj) {

          var marker = new L.Marker([obj.cur_lat, obj.cur_lng])
            .on("click", function() {
              set_reservation(obj.idScooter, obj.km)

            })
          route.addLayer(marker);
        });
      });
      map.addLayer(route);

      function set_reservation(scooter, km) {
        console.log(scooter)
        var bat = Math.floor(Math.random() * 100);
        $("#monopatin_id").text(scooter)
        $("#scooter_km").text(km)
        $("#scooter_bat").text(bat)
        $("#scooter_id").val(scooter)
        $("#modal_reserve").show()
      }
      $(".cerrar").on('click', function() {
        $("#modal_reserve").hide()
      })
      $("#confirm_reservation").on('click', function() {
        console.log($("#scooter_id").val())

      })

      $("#stop_reservation_btn").on('click', function () {
            var reservation_id = $("#reservation_id").val()
            console.log(reservation_id)
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "mapping/close_reservation.php",
                data: {idRide: reservation_id}
            }).done(function (rsp) {
             window.location.reload()
            });
        })

    })

/*
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "ece8a1b7-0971-44a2-aa15-6d2bb80aea21",
        safari_web_id: "web.onesignal.auto.14c8c5b3-a149-48e9-849f-677a5e5d7747",
        notifyButton: {
          enable: true,
        },
      });
    });
*/
    
    var OneSignal = window.OneSignal || [];
            OneSignal.push(["init", {
                appId: "ece8a1b7-0971-44a2-aa15-6d2bb80aea21",
                subdomainName: 'ourtutorial',
                appId: "ece8a1b7-0971-44a2-aa15-6d2bb80aea21",
        safari_web_id: "web.onesignal.auto.14c8c5b3-a149-48e9-849f-677a5e5d7747",
                autoRegister: true,
                promptOptions: {
                    /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
                    /* actionMessage limited to 90 characters */
                    actionMessage: "We'd like to show you notifications for the latest news.",
                    /* acceptButtonText limited to 15 characters */
                    acceptButtonText: "ALLOW",
                    /* cancelButtonText limited to 15 characters */
                    cancelButtonText: "NO THANKS"
                }
            }]);
      

            function subscribe() {
            
              // OneSignal.push(["registerForPushNotifications"]);
                OneSignal.push(["registerForPushNotifications"]);
                event.preventDefault();
            }
            function unsubscribe(){
              console.log('aca1s')
                OneSignal.setSubscription(true);
            }

            var OneSignal = OneSignal || [];
            OneSignal.push(function() {
                /* These examples are all valid */
                // Occurs when the user's subscription changes to a new value.
                OneSignal.on('subscriptionChange', function (isSubscribed) {
                    console.log("The user's subscription state is now:", isSubscribed);
                    OneSignal.sendTag("user_id","4444", function(tagsSent)
                    {
                        // Callback called when tags have finished sending
                        console.log("Tags have finished sending!");
                    });
                });

                var isPushSupported = OneSignal.isPushNotificationsSupported();
                if (isPushSupported)
                {
                    // Push notifications are supported
                    OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
                    {
                        if (isEnabled)
                        {
                            console.log("Push notifications are enabled!");

                        } else {
                            OneSignal.showHttpPrompt();
                            console.log("Push notifications are not enabled yet.");
                        }
                    });

                } else {
                    console.log("Push notifications are not supported.");
                }
            });

  </script>


</body>

</html>