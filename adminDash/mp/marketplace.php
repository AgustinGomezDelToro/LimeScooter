<?php
include("php/data_check.php");
include("php/config.php");
include("php/arbor_class.php");

extract($_SESSION);
$sdgs = $arbor->get_sdgs();
$prds = $arbor->get_products();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex,nofollow">
    <title>Arbor admin</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
    <!-- Custom CSS -->
    <link href="template/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="template/css/style.min.css" rel="stylesheet">
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin5">
            <?php include("top_bar.php"); ?>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php include("left_bar.php"); ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">

            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Marketplace</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Marketplace</a></li>
                            </ol>

                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">All Products</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Product Name</th>
                                            <th class="border-top-0">Product SDG</th>
                                            <th class="border-top-0">Unlock Shares</th>
                                            <th class="border-top-0">Thumb</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($prds as $v) {
                                            /*
                                               [0] => stdClass Object
        (
            [product_id] => 1
            [product_name] => testing product
            [product_sdg] => 2
            [unlock_shares] => 125
            [product_description] => sdfsdfsfdsdf
            [qr_text] => some text for the QR code
            [product_image] => product_1661787482.png
            [product_status] => 1
        )

)
*/
/*
$v->sdg_id . "' $sel>$v->sdg_name

                                            $sql = "SELECT COUNT(DISTINCT(donor_id)) as don FROM donors_projects WHERE project_id = $v->project_id";
                                            $d = $arbor->get_this_1($sql);
                                            $donors = $d->don;
*/

if($v->product_status === "1"){$status = "Published";} else {$status = "Paused";}
                                        ?>
                                            <tr>
                                                <td class="txt-oflo"><?php echo $v->product_name; ?></td>
                                                <td><?php echo $v->product_sdg; ?></td>
                                                <td><?php echo number_format($v->unlock_shares, 0, "", ","); ?></td>
                                                <td class="txt-oflo"><img class="img-fluid" width="50" height="50" src="../product_images/<?php echo $v->product_image; ?>"></td>
                                                <td><span class="text-success"><?php echo $status; ?></span></td>
                                                <td><span class="text-success"><a class="btn btn-success" href="product_edit.php?product_id=<?php echo $v->product_id; ?>">View</a></span></td>
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



                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <form method="post" action="new_product_save.php" enctype="multipart/form-data">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Add Product</h3>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name">
                                </div>

                                <div class="col-3">
                                    <label>Product SDG</label>
                                    <select class="form-control" name="product_sdg">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($sdgs as $v) {
                                            echo "<option value='" . $v->sdg_id . "'>$v->sdg_name</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Unlock Shares</label>
                                    <input type="text" class="form-control" name="unlock_shares">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Product Description</label>
                                    <input type="text" class="form-control" name="product_description">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>QR text</label>
                                    <input type="text" class="form-control" name="qr_text">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label>Product Image</label>
                                    <input type="file" class="form-control" name="product_image" id="imgInp">
                                </div>
                                <div class="col-6">
                                <img id="blah" src="#" class="img-fluid" alt="your image" />
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                  <button class="btn btn-success">Save new product</button>
                                </div>
                            </div>
                                    </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center"> <?php echo date('Y'); ?> © Arbor Admin </footer>

        </div>

    </div>

    <script src="template/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="template/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/js/app-style-switcher.js"></script>
    <script src="template/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="template/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="template/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="template/js/custom.js"></script>
    <!--This page JavaScript -->

    <script>
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
    </script>
</body>

</html>