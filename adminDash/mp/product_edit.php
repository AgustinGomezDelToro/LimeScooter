<?php
include("php/data_check.php");
include("php/config.php");
include("php/arbor_class.php");

extract($_SESSION);
$sdgs = $arbor->get_sdgs();
extract($_GET);
$prd = $arbor->get_this_product($product_id);

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
                        <form method="post" action="edit_product_save.php" enctype="multipart/form-data">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Edit Product</h3>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="<?php echo $prd->product_name;?>">
                                    <input type="hidden" name="product_id" value="<?php echo $prd->product_id;?>">
                                </div>

                                <div class="col-3">
                                    <label>Product SDG</label>
                                    <select class="form-control" name="product_sdg">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($sdgs as $v) {
                                            if ($v->sdg_id === $prd->product_sdg) {
                                                $sel = " selected ";
                                            } else {
                                                $sel = '';
                                            }

                                            echo "<option value='" . $v->sdg_id . "' $sel>$v->sdg_name</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Unlock Shares</label>
                                    <input type="text" class="form-control" name="unlock_shares" value="<?php echo $prd->unlock_shares;?>">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Product Description</label>
                                    <input type="text" class="form-control" name="product_description" value="<?php echo $prd->product_description;?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>QR text</label>
                                    <input type="text" class="form-control" name="qr_text" value="<?php echo $prd->qr_text;?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label>Product Image</label>
                                    <input type="file" class="form-control" name="product_image" id="imgInp">
                                </div>
                                <div class="col-6">
                                <img id="blah" class="img-fluid" alt="your image" src="../product_images/<?php echo $prd->product_image;?>" />
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label>Status</label>
                                    <select class="form-control" name="product_status">
                                        <option value="">Select</option>
                                        <?php
                                        
                                            if ($prd->product_status === "1") {
                                                echo "<option value='1' selected >Published</option>";
                                            } else 
                                                {
                                                    echo "<option value='1' >Published</option>"; 
                                            }
                                            if ($prd->product_status === "2") {
                                                echo "<option value='2' selected >Paused</option>";
                                            } else 
                                                {
                                                    echo "<option value='2' >Paused</option>"; 
                                            }
                                            
                                        
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                  <button class="btn btn-success">Save product</button>
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