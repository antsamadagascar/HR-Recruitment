<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="<?php echo site_url('template/assets/css/table.css'); ?>">
</head>
<body>
<div class="container">
    <h1>Liste des demandes de congés</h1>

    <!-- Affichage des messages flash -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Tableau des demandes -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employé</th>
                <th>Type de Congé</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Nombre de Jours</th>
                <th>Statut</th>
                <th>Date de Demande</th>
                <th>Motif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($demandes)): ?>
                <?php foreach ($demandes as $demande): ?>
                    <tr>
                        <td><?php echo $demande->id; ?></td>
                        <td><?php echo $demande->nomEmploye . ' ' . $demande->prenomEmploye; ?></td>
                        <td><?php echo $demande->typeConge; ?></td>
                        <td><?php echo $demande->dateDebut; ?></td>
                        <td><?php echo $demande->dateFin; ?></td>
                        <td><?php echo $demande->nombreJours; ?></td>
                        <td><?php echo $demande->statut; ?></td>
                        <td><?php echo $demande->datedemande; ?></td>
                        <td><?php echo $demande->motif; ?></td>
                        <td>
                            <a href="<?php echo site_url('Conge_Controller/valider/' . $demande->id); ?>" class="btn btn-success">Valider</a>
                            <a href="<?php echo site_url('Conge_Controller/rejeter/' . $demande->id); ?>" class="btn btn-danger">Rejeter</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Aucune demande de congé trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
