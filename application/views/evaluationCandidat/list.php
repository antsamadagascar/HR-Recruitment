<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des évaluations des candidats</title>
    <!-- Liens vers le fichier CSS pour un design propre -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .table-container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            color: #333;
        }

        td {
            font-size: 14px;
        }

        .btn-valid, .btn-refuse {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-right: 10px;
            font-weight: bold;
            color: #fff;
        }

        .btn-valid {
            background-color: #28a745;
        }

        .btn-refuse {
            background-color: #dc3545;
        }

        .btn-valid:hover {
            background-color: #218838;
        }

        .btn-refuse:hover {
            background-color: #c82333;
        }

        .actions {
            display: flex;
            justify-content: center;
        }

        .actions a {
            margin: 0 10px;
        }

        .no-records {
            text-align: center;
            font-size: 1.5rem;
            color: #777;
        }

        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-container input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 20%;
        }

        .filter-container button {
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
        }

        .filter-container button:hover {
            background-color: #0056b3;
        }

        .valid-message {
            color: #28a745;
            font-weight: bold;
        }

        .refused-message {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Liste des évaluations des candidats</h1>

        <!-- Formulaire de filtrage par note minimale -->
        <div class="filter-container">
            <label for="filter-note">Filtrer par note minimale : </label>
            <input type="number" id="filter-note" placeholder="Note minimale" min="0" max="100">
            <button onclick="filterNotes()">Filtrer</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de l'évaluation</th>
                        <th>Note (/100)</th>
                        <th>Status de validation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($evaluationcandidat as $evaluation): ?>
                        <tr>
                            <td><?php echo $evaluation->nom; ?></td>
                            <td><?php echo $evaluation->prenom; ?></td>
                            <td><?php echo $evaluation->dateevaluation; ?></td>
                            <td><?php echo $evaluation->notes; ?>/100</td>
                            
                            <!-- Affichage du statut de validation en fonction de la note -->
                            <td>
                                <?php if ($evaluation->notes >= 26): ?>
                                    <span class="valid-message">Validé</span>
                                <?php else: ?>
                                    <span class="refused-message">Refusé</span>
                                <?php endif; ?>
                            </td>
                            
                            <td class="actions">
                        <!-- Boutons pour valider ou refuser l'évaluation avec confirmation -->
                        <a href="<?php echo site_url('evaluationcandidat_controller/update_status/' . $evaluation->id . '/valid'); ?>" 
                           class="btn-valid" 
                           onclick="return confirmAction('valider', '<?php echo $evaluation->nom . ' ' . $evaluation->prenom; ?>')">
                            <i class="fas fa-check"></i> Valider
                        </a>
                        <a href="<?php echo site_url('evaluationcandidat_controller/update_status/' . $evaluation->id . '/refuse'); ?>" 
                           class="btn-refuse" 
                           onclick="return confirmAction('refuser', '<?php echo $evaluation->nom . ' ' . $evaluation->prenom; ?>')">
                            <i class="fas fa-times"></i> Refuser
                        </a>
                    </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (empty($evaluationcandidat)): ?>
                <p class="no-records">Aucun candidat n'a été évalué ou aucune évaluation à afficher.</p>
            <?php endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        function confirmAction(action, candidatName) {
            var message = "Êtes-vous sûr de vouloir " + action + " l'évaluation de " + candidatName + " ?";
            return confirm(message);
        }
    </script>
    <script>
        // Fonction pour filtrer les évaluations selon la note minimale
        function filterNotes() {
            let minNote = document.getElementById('filter-note').value;
            let rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                let note = parseFloat(row.cells[3].textContent.replace('/100', '').trim());
                if (note >= minNote || minNote === '') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>
