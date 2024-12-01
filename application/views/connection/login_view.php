<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Connecter votre Compte</h5>
                    <p class="text-center small">Entrer votre Email et votre Mot de Passe</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="<?php echo base_url($action); ?>" novalidate>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">S'il vous plaît entrer votre Email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="mot_de_passe" class="form-label">Mot de Passe</label>
                      <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe" required>
                      <div class="invalid-feedback">S'il vous plaît entrer votre Mot de Passe!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Connexion</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

              </div>

            </div>
          </div>
        </div>

      </section>