<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
/* Modern and Clean Table Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 20px;
    line-height: 1.6;
}

h2 {
    color: #2c3e50;
    text-align: center;
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

thead tr {
    height: 50px;
}

thead th {
    text-align: left;
    padding: 12px 15px;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 1px;
    border-bottom: 2px solid #2980b9;
}

tbody tr {
    transition: background-color 0.3s ease;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f7;
}

tbody tr:hover {
    background-color: #e6f2ff;
}

tbody td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
    color: #34495e;
}

/* Color-coded status indicators */
tbody td:nth-child(5), /* Jours Utilisés */
tbody td:nth-child(6), /* Jours Restants */
tbody td:nth-child(8)  /* Solde Final */ {
    font-weight: bold;
}

tbody td:nth-child(5) {
    color: #e74c3c; /* Used days in red */
}

tbody td:nth-child(6) {
    color: #2ecc71; /* Remaining days in green */
}

tbody td:nth-child(8) {
    color: #3498db; /* Final balance in blue */
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    table {
        border: 0;
        box-shadow: none;
    }
    
    table thead {
        display: none;
    }
    
    table tr {
        display: block;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    table td {
        display: block;
        text-align: right;
        border-bottom: 1px solid #ddd;
    }
    
    table td::before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    table td:last-child {
        border-bottom: 0;
    }
}

/* Print-friendly styles */
@media print {
    body {
        background-color: white;
    }
    
    table {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    thead {
        background-color: #f2f2f2 !important;
        color: black !important;
    }
}    
</style>
<body>
<h2>Suivi des Congés des Employés</h2>
<table border="1">
    <thead>
        <tr>
            <th>Employé</th>
            <th>Type de Congé</th>
            <th>Année</th>
            <th>Total Alloué</th>
            <th>Jours Utilisés</th>
            <th>Total Jours Pris</th>
            <th>Solde Final</th>
            <th>Dernier Congé Pris</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($conges as $conge): ?>
            <tr>
                <td><?= $conge->nom_employe . ' ' . $conge->prenom_employe ?></td>
                <td><?= $conge->type_conge ?></td>
                <td><?= $conge->annee ?></td>
                <td><?= $conge->total_jours_alloues ?></td>
                <td><?= $conge->jours_utilises ?></td>
                <td><?= $conge->total_jours_pris ?></td>
                <td><?= $conge->solde_final ?></td>
                <td><?= $conge->derniere_date_conge ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>