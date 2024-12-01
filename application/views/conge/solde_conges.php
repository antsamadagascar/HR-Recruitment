<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style> 
/* Employee Personal Leave Tracking Styling */
:root {
    --primary-color: #4a90e2;
    --secondary-color: #2ecc71;
    --text-color: #2c3e50;
    --background-color: #f4f6f9;
    --white: #ffffff;
    --accent-color: #3498db;
    --muted-color: #7f8c8d;
}

body {
    font-family: 'Inter', 'Arial', sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
    margin: 0;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background-color: var(--white);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

/* Table Header Styling */
table thead {
    background-color: var(--primary-color);
    color: var(--white);
}

table thead tr {
    height: 50px;
}

table thead th {
    padding: 12px 15px;
    text-align: left;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 1px;
    font-weight: 600;
}

/* Table Body Styling */
table tbody tr {
    transition: background-color 0.3s ease;
}

table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

table tbody tr:hover {
    background-color: #e9ecef;
}

table tbody td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
    color: var(--text-color);
}

/* Specific Column Styling */
/* Total Days */
table tbody td:nth-child(3) {
    font-weight: bold;
    color: var(--accent-color);
}

/* Used Days */
table tbody td:nth-child(4) {
    color: #e74c3c;
    font-weight: bold;
}

/* Remaining Days */
table tbody td:nth-child(5) {
    color: var(--secondary-color);
    font-weight: bold;
}

/* Date Columns */
table tbody td:nth-child(6),
table tbody td:nth-child(9) {
    color: var(--muted-color);
    font-size: 0.9em;
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

/* Print Friendly Styles */
@media print {
    body {
        background-color: white;
    }
    
    table {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    table thead {
        background-color: #f2f2f2 !important;
        color: black !important;
    }
}

/* Additional Enhancements */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

table {
    animation: fadeIn 0.5s ease-out;
}
</style>
<body>
<table>
    <thead>
        <tr>
        <th>Employé</th>
            <th>Type de Congé</th>
            <th>Année</th>
            <th>Total Alloué</th>
            <th>Jours Utilisés</th>
            <th>Jours restant</th>
            <th>Total Jours Pris</th>
            <th>Solde Final</th>
            <th>Dernier Congé Pris</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($soldes as $solde) : ?>
        <tr>
            <td><?= $solde->nom_employe . ' ' . $solde->prenom_employe ?></td>
                <td><?= $solde->type_conge ?></td>
                <td><?= $solde->annee ?></td>
                <td><?= $solde->total_jours_alloues ?></td>
                <td><?= $solde->jours_utilises ?></td>
                <td><?= $solde->jours_restants ?></td>
                <td><?= $solde->total_jours_pris ?></td>
                <td><?= $solde->solde_final ?></td>
                <td><?= $solde->derniere_date_conge ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    
</body>
</html>