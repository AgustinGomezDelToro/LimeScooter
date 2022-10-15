<?php
session_start();

if (empty($_SESSION)) {
    header("location:../index.php");
}
include("marketplace_class.php");

$sql = "SELECT * FROM products WHERE available = 1";
$prds = $mkt->get_this_all($sql);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Album example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">



    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>

    <header>

        <div class="navbar  shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="/tino/assets/images/logo/logo.svg" alt="Logo" height="25px" width="160px">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    
                </a>
                <button id="checkout_btn" type="button">
                    <i class="bi bi-cart"></i>
                    <span class="badge bg-secondary " id="total_cart_products">0</span>
                </button>
            </div>
        </div>
    </header>

    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Boutique</h1>

                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <!--

            [idProduct] => 1
            [name] => casque
            [description] => casque de protection
            [price_product] => 1
            [category] => 25
            [picture] => casque.png
            [quantity] => 60
            [price_order] => 60
            [vat] => 20
            [tag] => nouvelle
            [weight] => 30
            [available] => 1
    -->
                    <?php
                    foreach ($prds as $v) {
                    ?>


                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-head">
                                    <img class="card-img-top" style="max-height: 475px ;" src="../product_images/<?php echo $v->picture; ?>">
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $v->name; ?></p>
                                    <!--       <p class="card-text"><?php echo $v->description; ?></p> -->
                                    <p class="card-text">&euro; <span id="price_prod_unit_<?php echo $v->idProduct; ?>"><?php echo $v->price_order; ?></span></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary add" data-id="<?php echo $v->idProduct; ?>">+</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary remove" data-id="<?php echo $v->idProduct; ?>">-</button>
                                        </div>
                                        <p><small class="text-muted">Total: <span id="prod_<?php echo $v->idProduct; ?>">0</span></small></p><br>
                                        <p><small class="text-muted">Total &euro;: <span id="euro_prod_<?php echo $v->idProduct; ?>">0</span></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const cart_products = {
                total_products: 0,
                total_payment: 0
            }

            $(".add").on('click', function() {
                var cual = $(this).attr('data-id')
                var sel = parseInt($("#prod_" + cual).text())
                var new_tot = sel + 1

                cart_products.total_products = cart_products.total_products + 1

                $("#total_cart_products").text(cart_products.total_products)
                $("#prod_" + cual).text(new_tot)

                var este_precio = parseInt($("#price_prod_unit_" + cual).text())
                var pre_total = este_precio * new_tot;

                cart_products.total_payment = cart_products.total_payment + este_precio

                $("#euro_prod_" + cual).text(pre_total)

            })

            $(".remove").on('click', function() {
                var cual = $(this).attr('data-id')
                var sel = parseInt($("#prod_" + cual).text())
                if (sel === 0) {
                    $("#prod_" + cual).text(0)
                } else {
                    var new_tot = sel - 1
                    $("#prod_" + cual).text(new_tot)

                    var este_precio = parseInt($("#price_prod_unit_" + cual).text())
                    var pre_total = new_tot * este_precio;
                    cart_products.total_products = cart_products.total_products - 1
                    $("#total_cart_products").text(cart_products.total_products)

                    cart_products.total_payment = cart_products.total_payment - este_precio

                    $("#euro_prod_" + cual).text(pre_total)


                }
            })

            $("#checkout_btn").on('click', function() {
                if (cart_products.total_products === 0) {} else {
                    console.log(cart_products)

                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'checkout.php';


                    const hiddenField_prods = document.createElement('input');
                    hiddenField_prods.type = 'hidden';
                    hiddenField_prods.name = 'products';
                    hiddenField_prods.value = cart_products.total_products;
                    form.appendChild(hiddenField_prods);

                    const hiddenField_total = document.createElement('input');
                    hiddenField_total.type = 'hidden';
                    hiddenField_total.name = 'total';
                    hiddenField_total.value = cart_products.total_payment;
                    form.appendChild(hiddenField_total);

                    document.body.appendChild(form);
                    form.submit();

                }
            })
        })
    </script>

</body>

</html>