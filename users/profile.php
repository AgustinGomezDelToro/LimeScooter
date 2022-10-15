<?php
session_start();

if (empty($_SESSION)) {
  header("location:../index.php");
}

include "../controllers/Token.php";
include("../models/userModel.php");
$user_details = $userModel->get_details();

$udata = $userModel->get_this_user();

$rcs = $userModel->get_this_user_rides();


$payments = $userModel->get_this_client_payments();

$purchases = $userModel->get_this_client_purchases();


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
  <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />



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

        <div class="col" id="display_res">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Mes Details</h6>
            </div>
            <div class="card-body p-3">
              <div class="row mt-2">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <form method="post" action="profile_save.php">
                    <input type="hidden" name="idUser" value="<?php echo $udata->idUser; ?>">
                    <div class="white-box">
                      <div class="row">
                        <div class="col-6">
                          <label>Nom</label>
                          <input type="text" class="form-control" name="firstname" value="<?php echo $udata->firstname; ?>">
                        </div>
                        <div class="col-6">
                          <label>Prenom</label>
                          <input type="text" class="form-control" name="lastname" value="<?php echo $udata->lastname; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <label>Telephone</label>
                          <input type="text" class="form-control" name="phone" value="<?php echo $udata->phone; ?>">
                        </div>
                        <div class="col-4">
                          <label>Email</label>
                          <input type="text" class="form-control" name="email" value="<?php echo $udata->email; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <label>Address</label>
                          <input type="text" class="form-control" name="address" value="<?php echo $udata->address; ?>">
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col">
                          <button class="btn btn-success">Mettre à jour</button>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="row mt-4">

        <div class="col" id="display_res">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Mon historique de course</h6>
            </div>
            <div class="card-body p-3">
              <div class="row mt-2">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <div class="table">
                    <table class="table-responsive" id="carr_tbl">
                      <thead>
                        <tr>
                          <th>start_time</th>
                          <th>end_time</th>
                          <th>distance</th>
                          <th>price</th>
                          <th>number_scooter</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        foreach ($rcs as $v) {
                        ?>
                          <tr>
                            <td><?php echo $v->start_time; ?></td>
                            <td><?php echo $v->end_time; ?></td>
                            <td><?php echo $v->distance; ?></td>
                            <td><?php echo $v->price; ?></td>
                            <td><?php echo $v->number_scooter; ?></td>

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
        </div>
      </div>



      <div class="row mt-4">
        <div class="col" id="display_map">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Mon historique de paiement </h6>
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
                        <td><a class="btn btn-success" href="../adminDash/genere_facture.php?idPayment=<?php echo $v->idPayment; ?>" target="_BLANK">PDF</a></td>

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
              <h6> historique de mes achats</h6>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table" id="table_scooters">
                  <thead>
   
                    <tr>
                      <th>Date</th>
                      <th>Products</th>
                      <th>Amount (&euro;)</th>
                      <th>View</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    foreach ($purchases as $v) {

                    ?>

                      <tr>
                        <td><?php echo $v->date_purchase; ?></td>
                        <td><?php echo $v->amount_products; ?></td>
                        <td><?php echo $v->amount_purchase; ?></td>
                        <td><a class="btn btn-success" href="../adminDash/genere_purchase.php?idPurchase=<?php echo $v->idPurchase; ?>" target="_BLANK">PDF</a></td>

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
      $('#carr_tbl').DataTable();
    });
  </script>
</body>

</html>