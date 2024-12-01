<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>

              <!-- Table with stripped rows -->
              <table class="table table-hover datatable">
                <thead>
                  <tr>
                    <th>
                      <b>I</b>d
                    </th>
                    <th>Nom</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($ls_categorie_charge); $i++) { ?>
                  <tr>
                    <td class="number"><?php echo $ls_categorie_charge[$i]->id_categorie_charge; ?></td>
                    <td><?php echo $ls_categorie_charge[$i]->nom; ?></td>
                    <td><a href="<?php echo base_url('Form_Controller/categorie_charge?id_categorie_charge=' . $ls_categorie_charge[$i]->id_categorie_charge); ?>" class="btn btn-primary">Modifier</td>
                    <td><a href="<?php echo base_url('Action_Controller/delete?id=' . $ls_categorie_charge[$i]->id_categorie_charge . '&table_name=categorie_charge'); ?>" class="btn btn-danger">Supprimer</td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            <p class="text-center"> <a href="<?php echo base_url('Form_Controller/categorie_charge'); ?>" class="btn btn-secondary">Ajouter des Nouveaux</a> </p>

            </div>
          </div>

        </div>
      </div>
    </section>