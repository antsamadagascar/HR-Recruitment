<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle; ?></title>
</head>
<style>
/* Modern Leave Request Management Styling */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --danger-color: #e74c3c;
    --warning-color: #f39c12;
    --text-color: #2c3e50;
    --background-color: #f4f6f9;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Arial', sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
}

.container {
    width: 95%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 30px;
    font-weight: 300;
    position: relative;
    padding-bottom: 10px;
}

h1::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background-color: var(--primary-color);
}

/* Alert Styles */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-weight: bold;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Table Styles */
.table {
    width: 100%;
    background-color: var(--white);
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table thead {
    background-color: var(--primary-color);
    color: var(--white);
}

.table thead tr {
    height: 50px;
}

.table thead th {
    padding: 12px 15px;
    text-align: left;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 1px;
}

.table-striped tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.table tbody tr {
    transition: background-color 0.3s ease;
}

.table tbody tr:hover {
    background-color: #e9ecef;
}

.table tbody td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

/* Status Coloring */
.table tbody td:nth-child(7) {
    font-weight: bold;
}

.table tbody td:contains('En attente') {
    color: var(--warning-color);
}

.table tbody td:contains('Validé') {
    color: var(--secondary-color);
}

.table tbody td:contains('Rejeté') {
    color: var(--danger-color);
}

/* Action Buttons */
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin: 0 5px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success {
    background-color: var(--secondary-color);
    color: var(--white);
}

.btn-danger {
    background-color: var(--danger-color);
    color: var(--white);
}

.btn:hover {
    opacity: 0.8;
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .container {
        width: 100%;
        padding: 10px;
    }

    .table, 
    .table tbody, 
    .table tr, 
    .table td {
        display: block;
    }

    .table thead {
        display: none;
    }

    .table tr {
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .table td {
        text-align: right;
        border-bottom: 1px solid #ddd;
        position: relative;
        padding-left: 50%;
    }

    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        text-align: left;
        font-weight: bold;
    }
}

/* Print Friendly */
@media print {
    body {
        background: white;
    }

    .table {
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>
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
                        <td><?php echo $demande->nomemploye . ' ' . $demande->prenomemploye; ?></td>
                        <td><?php echo $demande->datedebut; ?></td>
                        <td><?php echo $demande->datefin; ?></td>
                        <td><?php echo $demande->nombrejours; ?></td>
                        <td><?php echo $demande->statut; ?></td>
                        <td><?php echo $demande->datedemande; ?></td>
                        <td><?php echo $demande->motif; ?></td>
                        <td>
                            <a href="<?php echo site_url('Conge_Controller/valider/' . $demande->id); ?>" class="btn btn-success">Verifier</a>
                        
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
