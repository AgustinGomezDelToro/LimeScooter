<?php
session_start();

require_once '../../vendor/autoload.php';


extract($_GET);

include("adminClass.php");

$py = $adm->get_this_payment($idPayment);

$facture_id = strtotime($py->date_action);

/*
  [idPayment] => 1
            [idUser] => 107
            [concept] => Forfait journalier pour 9,99€
            [amount] => 9,99
            [date_action] => 2022-08-31 08:50:13
            [firstname] => Benito Silva
            [lastname] => Gustavo

             [0] => stdClass Object
        (
            [idPurchase] => 1
            [idUser] => 107
            [amount_products] => 5
            [amount_purchase] => 141
            [date_purchase] => 2022-09-01
        )
            */

    $html = <<<AAA
    
    <html>
<head>
<style>
.factura {
    table-layout: fixed;
  }
  
  .fact-info > div > h5 {
    font-weight: bold;
  }
  
  .factura > thead {
    border-top: solid 3px #000;
    border-bottom: 3px solid #000;
  }
  
  .factura > thead > tr > th:nth-child(2), .factura > tbod > tr > td:nth-child(2) {
    width: 300px;
  }
  
  .factura > thead > tr > th:nth-child(n+3) {
    text-align: right;
  }
  
  .factura > tbody > tr > td:nth-child(n+3) {
    text-align: right;
  }
  
  .factura > tfoot > tr > th, .factura > tfoot > tr > th:nth-child(n+3) {
    font-size: 24px;
    text-align: right;
  }
  
  .cond {
    border-top: solid 2px #000;
  }
  </style>
</head>
<body>
</div><div id="app" class="col-11">

    <h2>Facture</h2>

    <div class="row my-3">
      <div class="col-10">
        <h1>EASYSCOOTER</h1>
        <p>13ter rue des longs pres </p>
        <p>paris</p>
        <p>75016</p>
      </div>
      <div class="col-2">
        <img src="https://agustingomezdeltoro.tech/tino/assets/images/logo/logo.svg" />
      </div>
    </div>
  
    <hr />
  
    <div class="row fact-info mt-3">
      <div class="col-3">
        <h5>CLIENT</h5>
        <p>
          $py->firstname $py->lastname
        </p>
      </div>
      
      <div class="col-3">
        <h5>N° de factura</h5>
        <h5>DATE</h5>
        
      </div>
      <div class="col-3">
        <h5>$facture_id</h5>
        <p>$py->date_action</p>
        
      </div>
    </div>
  
    <div class="row my-5">
      <table class="table table-borderless factura">
        <thead>
          <tr>
            <th>Voyage</th>
            <th>Ville</th>
            <th>Importe</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>$py->concept</td>
            <td>$py->amount</td>
            <td>$py->amount</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th>Total à payer </th>
            <th>€$py->amount</th>
          </tr>
        </tfoot>
      </table>
    </div>
</div>
</body>
    </hrml>

AAA;


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();