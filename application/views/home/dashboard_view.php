
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
<section class="section dashboard">
  <div class="row">

 
        <div class="col-xxl-3 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total Chiffre d'Affaire</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $chiffre_affaire; ?></h6>

                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-xxl-3 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total Charge <span>| Fixe</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-light">
                  <i class="bi bi-calendar3"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $total_charge_fixe; ?></h6>

                </div>
              </div>
            </div>

          </div>
        </div>

  
        <div class="col-xxl-3 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Total Charge <span>| Variable</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-light">
                  <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo $total_charge_variable; ?></h6>

                </div>
              </div>
            </div>

          </div>
        </div>


        <div class="col-xxl-3 col-xl-12">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Seuil de Rentabilité</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info text-light">
                  <i class="bi bi-coin"></i>
                </div>
                <div class="ps-3">
                  <h6>--php echo $seuil_rentabilite['ratio']; ?></h6>
                php if ($seuil_rentabilite['montant'] < 0) { ?>
                  <span class="text-danger small pt-1 fw-bold">php echo $seuil_rentabilite['montant'] ?></span> <span class="text-muted small pt-2 ps-1">reste</span>
                php } else { ?>
                  <span class="text-info small pt-1 fw-bold">php echo $seuil_rentabilite['montant'] ?></span> <span class="text-muted small pt-2 ps-1">dépassé</span>
                php } ?>

                </div>
              </div>

            </div>
          </div>

        </div>

  </div>
</section>