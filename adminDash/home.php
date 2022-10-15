<?php
session_start();

if(empty($_SESSION)){
  header("location:../index.php");
}

include "adminClass.php";

$stats = $adm->get_stats();

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
        <div class="col" id="display_map">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Scooters location</h6>
            </div>
            <div class="card-body p-3">
              <div id="map"></div>
            </div>
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
           
          route.addLayer(marker);
        });
      });
      map.addLayer(route);

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

    
  </script>

</body>

</html>