<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        /* Custom styles for the form */
        .container {
            margin-top: 30px;
        }

        .form-container {
            background-color: #f4f7fc;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-submit {
            width: 100%;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-submit:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Title of the page -->
        <h1 class="text-center"><?php echo $pagetitle; ?></h1>

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

        <!-- Embauche form -->
        <div class="form-container">
            <form action="<?php echo site_url('Embauche_Controller/create'); ?>" method="POST">
                <h2>Contrat d'essaie</h2>

                <div class="form-group">
                    <label for="idcandidat">Sélectionner un Candidat :</label>
                    <select name="idcandidat" id="idcandidat" class="form-control" required>
                        <option value="" disabled selected>Choisir un candidat</option>
                        <?php foreach ($candidats as $candidat): ?>
                            <option value="<?php echo $candidat->idcandidat; ?>">
                                <?php echo $candidat->nomcandidat . ' ' . $candidat->prenomcandidat; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idcontrat">Sélectionner un Contrat :</label>
                    <select name="idcontrat" id="idcontrat" class="form-control" required>
                        <option value="" disabled selected>Choisir un contrat</option>
                        <?php foreach ($contrats as $contrat): ?>
                            <option value="<?php echo $contrat->id; ?>">
                                <?php echo $contrat->nomcontrat . ' - Durée: ' . $contrat->duree . ' mois'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateDebut">Date de début :</label>
                    <input type="date" name="datedebut" id="datedebut" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="dateFin">Date de fin (si applicable) :</label>
                    <input type="date" name="datefin" id="dateFin" class="form-control">
                </div>

                <div class="form-group">
                    <label for="salaire">Salaire :</label>
                    <input type="number" name="salaire" id="salaire" class="form-control" placeholder="Entrez le salaire" required>
                </div>
                <input type="hidden" name="isembaucher"  value="true">

                <!-- Submit button -->
                <button type="submit" class="btn btn-submit">Valider</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
