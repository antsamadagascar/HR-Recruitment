<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de Paie</title>
    <style>
  
        .fiche-paie {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            color: #2c3e50;
            border-bottom: 1px solid #ecf0f1;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .ligne {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #f1f1f1;
        }
        .ligne-label {
            font-weight: bold;
            color: #34495e;
        }
        .ligne-value {
            color: #2980b9;
        }
        .net {
            font-weight: bold;
            color: #27ae60;
        }
        .footer {
            text-align: right;
            font-size: 0.8em;
            color: #7f8c8d;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="fiche-paie">
        <!-- Check if there are flash messages -->
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
        <div class="header">
            <h1>Fiche de Paie</h1>
            <p id="periode">Arrete au : <?php echo $fiche->mois . ' ' . $fiche->annee; ?></p>
        </div>

        <div class="section">
            <h2 class="section-title">Informations du Candidat</h2>
            <div class="ligne">
                <span class="ligne-label">Nom :</span>
                <span class="ligne-value" id="nom"><?php echo htmlspecialchars($fiche->nom); ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Prénom :</span>
                <span class="ligne-value" id="prenom"><?php echo htmlspecialchars($fiche->prenom); ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Date d'Embauche :</span>
                <span class="ligne-value" id="dateEmbauche"><?php echo date('d/m/Y', strtotime($fiche->dateEmbauche)); ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Ancienneté :</span>
                <span class="ligne-value" id="anciennete">
                    <?php
                        $dateEmbauche = new DateTime($fiche->dateEmbauche);
                        $dateActuelle = new DateTime();
                        $anciennete = $dateEmbauche->diff($dateActuelle);
                        echo $anciennete->y . ' an(s) et ' . $anciennete->m . ' mois';
                    ?>
                </span>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Détails de la Paie</h2>
            <div class="ligne">
                <span class="ligne-label">Salaire Brut :</span>
                <span class="ligne-value" id="salairebrut"><?php echo number_format($fiche->salairebrut, 2, ',', ' ') . ' Ar'; ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Salaire de Base :</span>
                <span class="ligne-value" id="salairebase"><?php echo number_format($fiche->salairebrut, 2, ',', ' ') . ' Ar'; ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Cotisations Sociales :</span>
                <span class="ligne-value" id="cotisations"><?php echo number_format($fiche->cotisations, 2, ',', ' ') . ' Ar'; ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Salaire Net :</span>
                <span class="ligne-value net" id="salairenet"><?php echo number_format($fiche->salairenet, 2, ',', ' ') . ' Ar'; ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Primes :</span>
                <span class="ligne-value" id="primes"><?php echo number_format($fiche->primes, 2, ',', ' ') . ' Ar'; ?></span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Taux Journalier :</span>
                <span class="ligne-value" id="tauxjournalier">
                    <?php
                        $tauxJournalier = $fiche->salairebrut / 30;
                        echo number_format($tauxJournalier, 2, ',', ' ') . ' Ar';
                    ?>
                </span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Taux Horaire :</span>
                <span class="ligne-value" id="tauxhoraire">
                    <?php
                        $tauxHoraire = $fiche->salairebrut / 160;
                        echo number_format($tauxHoraire, 2, ',', ' ') . ' Ar';
                    ?>
                </span>
            </div>
            <div class="ligne">
                <span class="ligne-label">Jours de Congés Payés :</span>
                <span class="ligne-value" id="joursconges"><?php echo $fiche->jourscongespayes . ' jours'; ?></span>
            </div>
        </div>

        <div class="footer">
            <p id="dategeneration">Date de génération : <?php echo date('d/m/Y H:i:s', strtotime($fiche->dategeneration)); ?></p>
        </div>
        <button id="exportPdf" class="btn btn-primary">Exporter en PDF</button>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Chargez jQuery ici -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#exportPdf').click(function() {
            const { jsPDF } = window.jspdf; // Déstructuration pour utiliser jsPDF
            const doc = new jsPDF();

            // Récupérer les informations du candidat et de la période
            var idCandidat = $("#nom").text().trim();  // Utilisation du nom comme identifiant
            var datePaie = $("#periode").text().trim();  // Période de la fiche de paie

            // Ajouter un titre au document PDF
            var titre = "Fiche de Paie - " + idCandidat + " - " + datePaie;
            doc.setFontSize(18);
            doc.text(titre, 20, 20); // Ajouter le titre en haut à gauche

            // Mise en page de la fiche de paie dans l'ordre
            let yPosition = 30; // Position de départ pour le contenu

            // Informations du candidat
            doc.setFontSize(14);
            doc.text('Informations du Candidat', 20, yPosition);
            yPosition += 10;

            doc.setFontSize(12);
            doc.text('Nom : ' + $("#nom").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Prénom : ' + $("#prenom").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Date d\'Embauche : ' + $("#dateEmbauche").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Ancienneté : ' + $("#anciennete").text().trim(), 20, yPosition);
            yPosition += 12;  // Espace avant la section suivante

            // Détails de la paie
            doc.setFontSize(14);
            doc.text('Détails de la Paie', 20, yPosition);
            yPosition += 10;

            doc.setFontSize(12);
            doc.text('Salaire Brut : ' + $("#salairebrut").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Salaire de Base : ' + $("#salairebase").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Cotisations Sociales : ' + $("#cotisations").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Salaire Net : ' + $("#salairenet").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Primes : ' + $("#primes").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Taux Journalier : ' + $("#tauxjournalier").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Taux Horaire : ' + $("#tauxhoraire").text().trim(), 20, yPosition);
            yPosition += 6;
            doc.text('Jours de Congés Payés : ' + $("#joursconges").text().trim(), 20, yPosition);
            yPosition += 12;  // Espace avant la section suivante

            // Footer avec la date de génération
            doc.setFontSize(10);
            doc.text('Date de génération : ' + $("#dategeneration").text().trim(), 20, yPosition);
            yPosition += 6;

            // Sauvegarder le fichier PDF
            doc.save(idCandidat + "_Fiche_de_Paie_" + datePaie + ".pdf");
        });
    });
</script>

</body>
</html>
