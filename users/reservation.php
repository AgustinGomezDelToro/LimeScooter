<?php
session_start();
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

                <div class="col">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h6>Scooters à louer (cliquez sur la carte pour définir la destination approximative)</h6>

                        </div>
                        <div class="card-body p-3">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal" tabindex="-1" id="step_1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Louer un scooter <span id="monopatin_id"></span></h5>
                        <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12" id="distance"></div>
                        <div class="col-12" id="duration"></div>
                        <?php
            
                        if ($plan === "Aucun abonnement") {
                        ?>

                            <div class="col-12" id="cost"></div>
                        <?php
                        }
                        ?>
                        <div class="col-12" id="reservar">
                            <input type="hidden" id="sccoter_id_input" value="<?php echo $_POST['scooter_id']; ?>">
                            <input type="hidden" id="user_id_input" value="<?php echo $_SESSION['userId']; ?>">
                            <input type="hidden" id="sccoter_lat_input">
                            <input type="hidden" id="sccoter_lng_input">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cerrar" data-bs-dismiss="step_1">Fermer</button>
                        <button id="confirm_reservation_btn" class="btn btn-primary">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>



        <div id="step_3" style="display:none">
            <div class="row mt-3 my-5">
                <h2>Votre réservation a été clôturée et vous avez été facturé &euro; <span id="total_charge"></span></h2>
                <h2>Vous avez gagné <span id="total_points"></span> point à votre portefeuille de points bonus.</h2>
            </div>
        </div>
        <footer class="footer pt-3 ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start"> ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, by Easyscooter</a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </main>
    <input type="hidden" id="selected_scooter" value="<?php echo $_POST['scooter_id']; ?>">
    <!--   Core JS Files   -->
    <script src="../../view/assets/js/core/popper.min.js"></script>
    <script src="../../view/assets/js/core/bootstrap.min.js"></script>
    <script src="../../view/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../view/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../view/assets/js/plugins/chartjs.min.js"></script>

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
            $(".cerrar").on('click', function() {
                $("#step_1").hide()
            })
            var userId = $("#user_id_input").val()
            const origin_coords = []
            const destination_coords = []
            const reservation_distance = []
            const reservation_cost = []
            const type_of_plan = <?php echo $pt; ?>
           

            var map = L.map('map').setView([45.75580771887143, 4.835828819141278], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            map.once('click', addMarker);

            function addMarker(e) {
                var newMarker = new L.marker(e.latlng, {
                    draggable: 'true'
                }).addTo(map);
                calculate_distance(e.latlng.lat, e.latlng.lng)
                destination_coords.lat = e.latlng.lat
                destination_coords.lng = e.latlng.lng

                newMarker.on('dragend', function(event) {
                    var marker = event.target;
                    var position = marker.getLatLng();

                    marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                        draggable: 'true'
                    });
                    map.panTo(new L.LatLng(position.lat, position.lng))
                    calculate_distance(position.lat, position.lng)
                    destination_coords.lat = position.lat
                    destination_coords.lng = position.lng
                });
            }

            var markers = [];
            var route = L.featureGroup();
            var data = {
                scooter: $("#selected_scooter").val()
            }
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "mapping/mapping_functions.php",
                data: data
            }).done(function(obj) {
                origin_coords.lat = obj.cur_lat
                origin_coords.lng = obj.cur_lng
                var marker = new L.Marker([obj.cur_lat, obj.cur_lng])
                    .on("click", function() {
                        alert('this is the scooter current location')
                    })
                route.addLayer(marker);

                //  map.panTo(origin_coords.lat, origin_coords.lng);
                map.flyTo([origin_coords.lat, origin_coords.lng], 14)
            });
            map.addLayer(route);

            function calculate_distance(lat, lng) {

                var destination_lat = lat
                var destination_lng = lng

                var url = 'http://router.project-osrm.org/route/v1/bike/' + origin_coords.lng + ',' + origin_coords.lat + ';' + destination_lng + ',' + destination_lat + '?overview=false';


                $.getJSON(url, function(data) {
                    var distance = parseFloat(data.routes[0].distance / 1000).toFixed(2)
                    $("#distance").text('Aproximate Distance: ' + distance + ' Km.')
                    reservation_distance.total = distance
                    var duration = parseInt(data.routes[0].duration)
                    var calc_duration = new Date(duration * 1000).toISOString().substr(11, 8);
                    $("#duration").text('Aproximate Duration: ' + calc_duration + '.')
                    var minutos = Math.floor(duration / 60);
                    var costo = minutos * 0.23
                    var costo_total = costo + 1
                    $("#cost").html('Aproximate Cost &euro;: ' + costo_total.toFixed(2) + '.')
                    $("#sccoter_lat_input").val(origin_coords.lat)
                    $("#sccoter_lng_input").val(origin_coords.lng)
                    $("#step_1").show()
                    $("#result_block").css('display', 'block')
                    reservation_cost.cost = costo_total
                });

            }

            $("#confirm_reservation_btn").on('click', function() {
                $("#confirm_reservation_btn").prop('disabled', true);
                var scooter = $("#sccoter_id_input").val()


                var data = {
                    scooter: scooter,
                    origin_lat: origin_coords.lat,
                    origin_lng: origin_coords.lng,
                    destination_lat: destination_coords.lat,
                    destination_lng: destination_coords.lng,
                    reservation_distance: reservation_distance.total,
                    userId: userId,
                    cost: reservation_cost.cost
                }

                if(type_of_plan === 1){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "mapping/reservation_process.php",
                    data: data
                }).done(function(rsp) {
                    window.location.href = "home.php"
                });
            } else {


                window.location.href = "charge_reservation.php?data="+JSON.stringify(data);
               
            }
            })





        })
    </script>
</body>

</html>