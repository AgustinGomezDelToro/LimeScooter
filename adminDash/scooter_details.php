<?php
session_start();

if (empty($_SESSION)) {
    header("location:../index.php");
}

include "adminClass.php";

$stats = $adm->get_stats();

$scooter = $_GET['sc'];

$sc = $adm->get_this_scooter($scooter);

/*
stdClass Object
(
    [idScooter] => 333
    [number] => 12
    [condition] => 1
    [km] => 885
    [location] => 
    [status] => 1
    [workzone] => Nation
    [cur_lat] => 45.73242633226291
    [cur_lng] => 4.904365539550782
    [images] => https://contents.mediadecathlon.com/p2040488/k$1d6aa4f8b06437ac59158561d367fb61/sq/trottinette-electrique-xiaomi-essential.jpg?format=auto&f=720x720
)

*/
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

            <!--
      [idScooter] => 331
            [number] => 26
            [condition] => 1
            [km] => 91
            [location] => 
            [status] => 0
            [workzone] => Nation
            [cur_lat] => 45.75580771887143
            [cur_lng] => 4.835828819141278
            [images] => https://contents.mediadecathlon.com/p2040488/k$1d6aa4f8b06437ac591
-->
            <div class="row mt-4">
                <div class="col" id="display_map">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h6>Informations Trottinettes</h6>
                        </div>
                        <div class="card-body p-3">
                            <div id="infoScooter" class="table-responsive p-0">
                                <div class="row mt-5">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <form method="post" action="edit_scooter_save.php" enctype="multipart/form-data">
                                        <input type="hidden"  name="idScooter" value="<?php echo $sc->idScooter;?>">
                                            <div class="white-box">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <label>Number</label>
                                                        <input type="text" class="form-control" name="number" value="<?php echo $sc->number;?>">
                                                    </div>
                                                    <div class="col-2">
                                                        <label>Km</label>
                                                        <input type="text" class="form-control" name="km" value="<?php echo $sc->km;?>">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Status</label>
                                                        <select class="form-select" name="status">
                                                            <option value="1" <?php if($sc->status === "1"){echo " selected ";}?> >Free</option>
                                                            <option value="2" <?php if($sc->status === "2"){echo " selected ";}?> >Reserved</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Condition</label>
                                                        <select class="form-select" name="condition">
                                                            <option value="1" <?php if($sc->condition === "1"){echo " selected ";}?> >Available</option>
                                                            <option value="2" <?php if($sc->condition === "2"){echo " selected ";}?> >Unavailable</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <label>Photo du produit</label>
                                                        <input type="file" class="form-control" name="images" id="imgInp">
                                                    </div>
                                                    <div class="col-6">
                                                        <img id="blah" src="../scooter_images/<?php echo $sc->images;?>" class="img-fluid" alt="your image" />
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <button class="btn btn-success">Enregistrer scooter</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                         
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

    <script>
        $(document).ready(function() {

            imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}

        })
    </script>

</body>

</html>