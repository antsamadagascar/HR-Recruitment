<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        /* Styles inchangés (voir code original) */
        .container {
            max-width: 1300px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .content {
            padding: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: 20px;
        }

        th, td {
            padding: 16px;
            background: white;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        tr td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        tr td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .btn-export {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        .btn-export:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <?php if (!empty($contrat)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Informations</th>
                        <th>Type</th>
                        <th>Poste</th>
                        <th>Période</th>
                        <th>Salaire</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contrat as $c): ?>
                    <tr>
                        <td>#<?php echo $c->idembauche; ?></td>
                        <td>
                            <div style="font-weight: 600;"><?php echo $c->nomcandidat . ' ' . $c->prenomcandidat; ?></div>
                            <div style="color: #718096; font-size: 13px;">ID: #<?php echo $c->idcandidat; ?></div>
                        </td>
                        <td><?php echo $c->typecontrat; ?></td>
                        <td><?php echo $c->nomcontrat; ?></td>
                        <td>
                            <div>Début: <?php echo date('d/m/Y', strtotime($c->datedebutembauche)); ?></div>
                            <div>Fin: <?php echo empty($c->datefinembauche) ? 'Indéterminée' : date('d/m/Y', strtotime($c->datefinembauche)); ?></div>
                        </td>
                        <td><?php echo number_format($c->salaire, 0, ',', ' '); ?> €/an</td>
                        <td>
                            <button class="btn-export" onclick="exportPDF('<?php echo $c->idembauche; ?>', '<?php echo $c->nomcandidat; ?>', '<?php echo $c->prenomcandidat; ?>', '<?php echo $c->typecontrat; ?>', '<?php echo $c->nomcontrat; ?>', '<?php echo date('d/m/Y', strtotime($c->datedebutembauche)); ?>', '<?php echo $c->datefinembauche ? date('d/m/Y', strtotime($c->datefinembauche)) : 'Indéterminée'; ?>', '<?php echo number_format($c->salaire, 0, ',', ' '); ?>')">Exporter PDF</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>Aucun contrat disponible.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function exportPDF(id, nom, prenom, type, poste, debut, fin, salaire) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.setFont("helvetica", "bold");
            doc.setFontSize(18);
            doc.text("Détails du Contrat", 105, 20, { align: "center" });

            doc.setFontSize(12);
            doc.setFont("helvetica", "normal");
            doc.text(`ID du Contrat : ${id}`, 10, 40);
            doc.text(`Nom du Candidat : ${nom} ${prenom}`, 10, 50);
            doc.text(`Type de Contrat : ${type}`, 10, 60);
            doc.text(`Poste : ${poste}`, 10, 70);
            doc.text(`Début : ${debut}`, 10, 80);
            doc.text(`Fin : ${fin}`, 10, 90);
            doc.text(`Salaire Annuel : ${salaire} Ar/mois`, 10, 100);

            // Ajout de la zone pour la signature du PDG
            doc.text("Signature PDG:", 10, 120);
            doc.line(60, 120, 180, 120); // Ligne de signature
            doc.text("PDG", 60, 130); // Nom du PDG

            // Ajout de la zone pour la signature de la personne du contrat
            doc.text("Signature Personne du Contrat:", 10, 150);
            doc.line(90, 150, 210, 150); // Ligne de signature
            doc.text(`${nom} ${prenom}`, 90, 160); // Nom dynamique de la personne

            // Sauvegarde du PDF
            doc.save(`Contrat_${id}.pdf`);
        }
    </script>
</body>
</html>
