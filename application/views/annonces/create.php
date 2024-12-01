<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Annonces RH</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="<?php echo site_url('template/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: white !important;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.25);
            border-color: var(--secondary-color);
        }

        .btn-success {
            background-color: #2ecc71;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }

        #searchInput {
            border-radius: 20px;
            padding-left: 2.5rem;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
        }

        .nav-tabs .nav-link {
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            padding: 1rem 2rem;
        }

        .nav-tabs .nav-link.active {
            color: var(--secondary-color);
            border-bottom: 3px solid var(--secondary-color);
        }

        .tab-content {
            background-color: white;
            border-radius: 0 0 10px 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-bullhorn me-2"></i>
                Gestion des Annonces RH
            </a>
        </div>
    </nav>

    <div class="container">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#liste" type="button">
                    <i class="fas fa-list me-2"></i>Liste des besoins
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#creation" type="button">
                    <i class="fas fa-plus-circle me-2"></i>Nouvelle annonce
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="liste">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une annonce...">
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-outline-secondary me-2" id="refreshTable">
                            <i class="fas fa-sync-alt me-2"></i>Actualiser
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <?php if (!empty($besoin_talents)): ?>
                    <table class="table table-hover" id="annonceTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-id-badge me-2"></i>ID</th>
                                <th><i class="fas fa-briefcase me-2"></i>Poste</th>
                                <th><i class="fas fa-user-tie me-2"></i>Profil</th>
                                <th><i class="fas fa-align-left me-2"></i>Description</th>
                                <th><i class="fas fa-users me-2"></i>Postes</th>
                                <th><i class="fas fa-code me-2"></i>Exp. Technique</th>
                                <th><i class="fas fa-chart-line me-2"></i>Exp. Générale</th>
                                <th><i class="fas fa-calendar-alt me-2"></i>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($annonces as $annonce): ?>
                            <tr>
                                <td><?php echo $annonce->besoin_id; ?></td>
                                <td><?php echo $annonce->nomposte; ?></td>
                                <td><?php echo $annonce->nomprofil; ?></td>
                                <td><?php echo $annonce->profil_description; ?></td>
                                <td><?php echo $annonce->nombredepostes; ?></td>
                                <td><?php echo $annonce->experiencetechnique; ?></td>
                                <td><?php echo $annonce->experiencegenerale; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($annonce->datebesoin)); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun besoin en talent disponible.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="creation">
                <form action="<?php echo site_url('Annonce/create'); ?>" method="post" id="annonceForm" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-heading me-2"></i>Titre
                            </label>
                            <input type="text" name="titre" class="form-control" required>
                            <div class="invalid-feedback">
                                Veuillez saisir un titre
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-users me-2"></i>Besoin de Talent
                            </label>
                            <select name="idbesoinentalent" class="form-select" required>
                                <option value="">Sélectionnez un besoin</option>
                                <?php foreach ($besoin_talents as $besoin): ?>
                                    <option value="<?php echo $besoin->id; ?>">
                                        <?php echo $besoin->id . ' - ' . $besoin->nomprofil; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un besoin
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-plus me-2"></i>Date de début
                            </label>
                            <input type="date" name="datedebut" class="form-control" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une date de début
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-minus me-2"></i>Date de fin
                            </label>
                            <input type="date" name="datefin" class="form-control" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une date de fin
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-align-left me-2"></i>Description
                        </label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Veuillez saisir une description
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary me-2" id="resetForm">
                            <i class="fas fa-undo me-2"></i>Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane me-2"></i>Publier l'annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="floating-alert alert alert-success" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <span id="alertMessage"></span>
    </div>

    <script src="<?php echo site_url('template/assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('annonceForm');
            const searchInput = document.getElementById('searchInput');
            const resetButton = document.getElementById('resetForm');
            const refreshButton = document.getElementById('refreshTable');

            // Fonction pour afficher une alerte
            function showAlert(message, type = 'success') {
                const alert = document.querySelector('.floating-alert');
                alert.className = `floating-alert alert alert-${type}`;
                document.getElementById('alertMessage').textContent = message;
                alert.style.display = 'block';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            }

            // Validation du formulaire
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    showAlert('Veuillez remplir tous les champs requis', 'danger');
                } else {
                    showAlert('Traitement en cours...', 'info');
                }
                form.classList.add('was-validated');
            });

            // Réinitialisation du formulaire
            resetButton.addEventListener('click', function() {
                form.reset();
                form.classList.remove('was-validated');
            });

            // Recherche dans le tableau
            searchInput.addEventListener('input', function() {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('#annonceTable tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchText) ? '' : 'none';
                });
            });

            // Actualisation du tableau
            refreshButton.addEventListener('click', function() {
                this.classList.add('fa-spin');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });

            // Validation des dates
            const dateDebut = document.querySelector('input[name="datedebut"]');
            const dateFin = document.querySelector('input[name="datefin"]');

            dateDebut.addEventListener('change', function() {
                dateFin.min = this.value;
            });

            dateFin.addEventListener('change', function() {
                if (this.value < dateDebut.value) {
                    this.value = dateDebut.value;
                    showAlert('La date de fin doit être supérieure à la date de début', 'warning');
                }
            });

            // Gestion des erreurs PHP
            <?php if(isset($error)): ?>
                showAlert("<?php echo $error; ?>", 'danger');
            <?php endif; ?>

            // Gestion des succès PHP
            <?php if(isset($success)): ?>
                showAlert("<?php echo $success; ?>", 'success');
            <?php endif; ?>
        });
    </script>
</body>
</html>