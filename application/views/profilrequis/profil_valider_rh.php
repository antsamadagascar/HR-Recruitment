<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h1 class="text-center">Profils Validés par le RH</h1>

    <?php if (!empty($profilCandidats)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Qualité Requise</th>
                    <th>Compétence</th>
                    <th>Profil Requis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profilCandidats as $profil): ?>
                    <tr>
                        <td><?= htmlspecialchars($profil->nom_candidat) ?></td>
                        <td><?= htmlspecialchars($profil->prenom_candidat) ?></td>
                        <td><?= htmlspecialchars($profil->qualite_requise) ?></td>
                        <td><?= htmlspecialchars($profil->competence_description) ?> (<?= htmlspecialchars($profil->competence_niveau) ?>)</td>
                        <td><?= htmlspecialchars($profil->profil_requis) ?></td>
                        <td>
                            <button 
                                class="btn btn-success btn-sm" 
                                onclick="handleAccept(<?= htmlspecialchars($profil->candidat_id) ?>)">
                                Accepter
                            </button>
                            <button 
                                class="btn btn-danger btn-sm" 
                                onclick="handleReject(<?= htmlspecialchars($profil->candidat_id) ?>)">
                                Refuser
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Aucun profil validé par le RH trouvé.</p>
    <?php endif; ?>
</div>

<script>
    function handleAccept(candidatId) {
    if (confirm("Êtes-vous sûr d'accepter ce candidat ?")) {
        fetch('<?= site_url("CV_Controller/validerCv") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ candidatId: candidatId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat accepté avec succès !Le Responsable de communication sera notifier pour dire aux candidats de passer aux Test!");
                location.reload(); 
            } else {
                alert("Erreur lors de l'acceptation du candidat.");
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite.");
        });
    }
}

function handleReject(candidatId) {
    if (confirm("Êtes-vous sûr de refuser ce candidat ?")) {
        fetch('<?= site_url("CV_Controller/refuserCv") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ candidatId: candidatId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat refusé avec succès !");
                location.reload();
            } else {
                alert("Erreur lors du refus du candidat.");
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite.");
        });
    }
}

</script>

    
</body>
</html>