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

                                                Array
(
    [user] => stdClass Object
        (
            [total_users] => 3
        )

    [rides] => stdClass Object
        (
            [total_rides] => 5
            [total_distance] => 436
            [total_earnings] => 205
        )

)

        -->
       
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total des utilisateurs</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $stats['user']->total_users;?></h5>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total des courses</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $stats['rides']->total_rides;?></h5>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Distance totale</p>
                    <h5 class="font-weight-bolder mb-0"><?php echo $stats['rides']->total_distance;?> Km.</h5>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total des gains</p>
                    <h5 class="font-weight-bolder mb-0">&euro; <?php echo $stats['rides']->total_earnings;?></h5>
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