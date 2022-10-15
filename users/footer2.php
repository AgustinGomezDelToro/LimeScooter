

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script>
    $(document).ready(function () {
        var userId = $("#user_id_input").val()
        check_reservation(userId)

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

            newMarker.on('dragend', function (event) {
                var marker = event.target;
                var position = marker.getLatLng();

                marker.setLatLng(new L.LatLng(position.lat, position.lng), {
                    draggable: 'true'
                });
                map.panTo(new L.LatLng(position.lat, position.lng))
                calculate_distance(position.lat, position.lng)
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
        }).done(function (obj) {
            $("#origin_lat").val(obj.cur_lat)
            $("#origin_lng").val(obj.cur_lng)
            var marker = new L.Marker([obj.cur_lat, obj.cur_lng])
                    .on("click", function () {
                        set_reservation(obj.idScooter)
                    })
            route.addLayer(marker);

// map.panTo(obj.cur_lat, obj.cur_lng);
        });
        map.addLayer(route);

        function calculate_distance(lat, lng) {

            var origin_lat = $("#origin_lat").val()
            var origin_lng = $("#origin_lng").val()

            var destination_lat = lat
            var destination_lng = lng

            var url = 'http://router.project-osrm.org/route/v1/bike/' + origin_lng + ',' + origin_lat + ';' + destination_lng + ',' + destination_lat + '?overview=false';


            $.getJSON(url, function (data) {
                var distance = parseFloat(data.routes[0].distance / 1000).toFixed(2)
                $("#distance").text('Aproximate Distance: ' + distance + ' Km.')
                var duration = parseInt(data.routes[0].duration)
                var calc_duration = new Date(duration * 1000).toISOString().substr(11, 8);
                $("#duration").text('Aproximate Duration: ' + calc_duration + '.')
                var minutos = Math.floor(duration / 60);
                var costo = minutos * 0.23
                var costo_total = costo + 1
                $("#cost").html('Aproximate Cost &euro;: ' + costo_total.toFixed(2) + '.')
                $("#sccoter_lat_input").val(origin_lat)
                $("#sccoter_lng_input").val(origin_lng)
                $("#result_block").css('display', 'block')
            });

        }

        $("#confirm_reservation_btn").on('click', function () {
            $("#confirm_reservation_btn").prop('disabled', true);
            var scooter = $("#sccoter_id_input").val()
            var origin_lat = $("#sccoter_lat_input").val()
            var origin_lng = $("#sccoter_lng_input").val()

            var data = {
                scooter: scooter,
                origin_lat: origin_lat,
                origin_lng: origin_lng,
                userId: userId
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "mapping/reservation_process.php",
                data: data
            }).done(function (rsp) {
                console.log(rsp)
                $("#step_1").css('display', 'none')
                $("#step_2").css('display', 'block')
                start_timer(0)
            });
        })

        function start_timer(seconds) {
            var minutesLabel = document.getElementById("minutes");
            var secondsLabel = document.getElementById("seconds");
            var totalSeconds = seconds;
            setInterval(setTime, 1000);



            function setTime() {
                ++totalSeconds;
                secondsLabel.innerHTML = "<h1>" + pad(totalSeconds % 60) + "</h1>";
                minutesLabel.innerHTML = "<h1>" + pad(parseInt(totalSeconds / 60)) + "</h1>";
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
            }).done(function (rsp) {
                if (rsp.seconds) {
                    $("#step_1").css('display', 'none')
                    $("#step_2").css('display', 'block')
                    $("#reservation_id").val(rsp.idRide)
                    start_timer(parseInt(rsp.seconds))
                }
            });
        }

        $("#stop_reservation_btn").on('click', function () {
            var reservation_id = $("#reservation_id").val()
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "mapping/close_reservation.php",
                data: {idRide: reservation_id}
            }).done(function (rsp) {
                $("#total_charge").html(rsp.cost)
                $("#total_points").html(rsp.total_points)
                $("#step_2").css('display', 'none')
                $("#step_3").css('display', 'block')
            });
        })
    })
</script>
</body>

</html>