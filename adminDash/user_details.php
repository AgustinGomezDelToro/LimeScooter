<?php
session_start();

if (empty($_SESSION)) {
    header("location:../index.php");
}

include "adminClass.php";

$stats = $adm->get_stats();
extract($_GET);
$user = $adm->get_this_client($us);

$rides = $adm->get_this_client_rides($us);

$payments = $adm->get_this_client_payments($us);

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
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

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

            <div class="row mt-5">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <form method="post" action="edit_user_save.php">
                        <input type="hidden" name="idUser" value="<?php echo $user->idUser; ?>">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Edit User</h3>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $user->firstname; ?>">
                                </div>
                                <div class="col-4">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lastname" value="<?php echo $user->lastname; ?>">
                                </div>

                                <div class="col-4">
                                    <label>email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>">
                                </div>

                                <div class="col-3">
                                    <label>phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $user->phone; ?>">
                                </div>
                                <div class="col-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $user->address; ?>">
                                </div>
                                <div class="col-3">
                                    <label>zipcode</label>
                                    <input type="text" class="form-control" name="zipcode" value="<?php echo $user->zipcode; ?>">
                                </div>
                                <div class="col-3">
                                    <label>points</label>
                                    <input type="text" class="form-control" name="points" value="<?php echo $user->points; ?>">
                                </div>
                                <div class="col-3">
                                    <label>wallet</label>
                                    <input type="text" class="form-control" name="wallet" value="<?php echo $user->wallet; ?>">
                                </div>
                                <div class="col-3">
                                    <label>birthdate</label>
                                    <input type="text" class="form-control" name="birthdate" value="<?php echo $user->birthdate; ?>">
                                </div>
                                <div class="col-3">
                                    <label>State</label>
                                    <select class="form-select" name="state">
                                        <option value="2" <?php if ($user->state === "2") {
                                                                echo "selected ";
                                                            } ?>>Active</option>
                                        <option value="3" <?php if ($user->state === "3") {
                                                                echo "selected ";
                                                            } ?>>Blocked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2">
                                    <button type="button" id="delete_btn" class="btn btn-danger" data-id="<?php echo $user->idUser; ?>">Eliminar</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button class="btn btn-success">Edit User</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col" id="display_map">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Rides</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table" id="table_scooters">
                                <thead>

                                    <tr>
                                        <th>start_time</th>
                                        <th>end_time</th>
                                        <th>number_scooter</th>
                                        <th>Duration</th>
                                        <th>distance</th>
                                        <th>price</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($rides as $v) {
                                        $datetime_1 = $v->start_time;
                                        $datetime_2 = $v->end_time;

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));

                                        $duration = $diff->h . ':' . $diff->i . ':' . $diff->s;
                                    ?>

                                        <tr>
                                            <td><?php echo $v->start_time; ?></td>
                                            <td><?php echo $v->end_time; ?></td>
                                            <td><?php echo $v->number_scooter; ?></td>
                                            <td><?php echo $duration; ?></td>
                                            <td><?php echo $v->distance; ?></td>
                                            <td><?php echo $v->price; ?></td>

                                        </tr>

                                    <?php
                                    }


                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col" id="display_map">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Payments</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table" id="table_scooters">
                                <thead>

                                    <tr>
                                        <th>Date</th>
                                        <th>Concept</th>
                                        <th>Amount (&euro;)</th>
                                        <th>View</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($payments as $v) {
                                       
                                    ?>

                                        <tr>
                                            <td><?php echo $v->date_action; ?></td>
                                            <td><?php echo $v->concept; ?></td>
                                            <td><?php echo $v->amount; ?></td>
                                            <td><a class="btn btn-success" href="genere_facture.php?idPayment=<?php echo $v->idPayment; ?>" target="_BLANK">PDF</a></td>

                                        </tr>

                                    <?php
                                    }


                                    ?>
                                </tbody>
                            </table>
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
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#table_scooters').DataTable();

            $("#delete_btn").on('click', function() {
                var prod = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //ajax al delete, un solo odigo y q deleteo
                        $.post("delete_script.php", {
                                type: "user",
                                id: prod
                            },
                            function(data, status) {
                                // console.log("Data: " + data + "\nStatus: " + status);
                                window.location.href = 'marketplace.php'
                            });

                    }
                })

            })

        })

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>