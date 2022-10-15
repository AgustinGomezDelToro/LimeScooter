<!--
    /*
Array
(
    [user] => stdClass Object
        (
            [points] => 12.60
            [wallet] => 
            [subscription] => 50
        )

    [rides] => stdClass Object
        (
            [total_rides] => 1
        )

)
*/
<div class="form-check">
<input class="form-check-input" type="radio" checked name="forfait" value="1" id="customRadio2">
<label class="custom-control-label"  for="customRadio2">forfait journalier pour 9,99€</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="forfait" value="8" id="customRadio2">
<label class="custom-control-label" for="customRadio2">8 trajets pour 19,99€</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="forfait" value="25" id="customRadio2">
<label class="custom-control-label" for="customRadio2">25 trajets pour 44,99€</label>
</div>
</div>
<div class="col">
<div class="form-check">
<input class="form-check-input" type="radio" name="forfait" value="50" id="customRadio2">
<label class="custom-control-label" for="customRadio2">50 trajets pour 79,99€</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="forfait" value="NA" id="customRadio2">
<label class="custom-control-label" for="customRadio2">Aucun abonnement</label>
                                                </div>
        -->
        <?php
        
    if($user_details['user']->subscription === "1"){$plan = "1 Ride"; $pn = 1; $pt = 1;}
    if($user_details['user']->subscription === "8"){$plan = "8 Rides";$pn = 8;$pt = 1;}
    if($user_details['user']->subscription === "25"){$plan = "25 Rides";$pn = 25;$pt = 1;}
    if($user_details['user']->subscription === "50"){$plan = "50 Rides";$pn = 50;$pt = 1;}
    if($user_details['user']->subscription === "NA"){$plan = "Aucun abonnement";$pt = 0;}

$puntos = $user_details['user']->points;
$viajes = $user_details['rides']->total_rides;
if($plan === "Aucun abonnement"){
    $remain = 0;
} else {
   $remain = $pn - $viajes; 
}


?>
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Forfait</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $plan;?></h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Voyages restants</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $remain;?></h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Points</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $puntos;?></h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total des trajets</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $viajes;?></h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>