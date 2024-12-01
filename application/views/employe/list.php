<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f6;
    margin: 0;
    padding: 20px;
    color: #333;
    line-height: 1.6;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
    font-weight: 300;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
}

thead {
    background-color: #3498db;
    color: white;
}

th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9em;
}

td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

tbody tr:hover {
    background-color: #f1f3f5;
    transition: background-color 0.3s ease;
}

button {
    background-color: #2ecc71;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9em;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #27ae60;
}

button:disabled {
    background-color: #bdc3c7;
    cursor: not-allowed;
}

p {
    text-align: center;
    color: #7f8c8d;
    font-style: italic;
}

form {
    display: inline-block;
}
</style>
<body>
<h1><?php echo $pagetitle; ?></h1>

<?php if (!empty($employes)): ?>
    <table border="1">
    <thead>
        <tr>
            <th>ID Candidat</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Type de Contrat</th>
            <th>Nom du Contrat</th>
            <th>Durée</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($employes)): ?>
            <?php foreach ($employes as $employe): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employe['idcandidat'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['nom'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['prenom'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['email'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['datedebut'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['datefin'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['typecontrat'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['nomcontrat'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($employe['duree'] ?? 'N/A'); ?></td>
                    <td>
                        <?php 
                        $congeAttribue = isset($employe['conge_attribue']) ? $employe['conge_attribue'] : false; 
                        ?>
                        <?php if ($congeAttribue): ?>
                            <button disabled class="btn btn-secondary">Droit Congé Attribué</button>
                        <?php else: ?>
                            <form action="<?php echo site_url('employe_controller/calculerConges'); ?>" method="POST">
                                <input type="hidden" name="employeId" value="<?php echo htmlspecialchars($employe['idcandidat']); ?>">
                                <button type="submit" class="btn btn-primary">Attribuer Droit Congé</button>
                            </form>
                        <?php endif; ?>

                        <form action="<?php echo site_url('ficheDePaie_controller/genererFicheDePaie'); ?>" method="POST">
                            <input type="hidden" name="employeId" value="<?php echo htmlspecialchars($employe['idcandidat']); ?>">
                            
                            <?php
                            // More robust month and year calculation
                            $currentMonth = date('m');
                            $currentYear = date('Y');
                            
                            // Calculate previous month and year
                            $moisPrecedent = $currentMonth == 1 ? 12 : $currentMonth - 1;
                            $anneePrecedente = $currentMonth == 1 ? $currentYear - 1 : $currentYear;
                            ?>
                            
                            <input type="hidden" name="mois" value="<?php echo $moisPrecedent; ?>">
                            <input type="hidden" name="annee" value="<?php echo $anneePrecedente; ?>">
                            <button type="submit" class="btn btn-success">Générer Fiche de Paie</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" class="text-center">Aucun employé trouvé</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Aucun employé trouvé.</p>
<?php endif; ?>

</body>
</html>
