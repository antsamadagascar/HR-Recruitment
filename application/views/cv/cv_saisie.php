<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #eef2ff;
            --success: #22c55e;
            --warning: #eab308;
            --error: #ef4444;
            --background: #f8fafc;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
            padding: 2rem;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .form-header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .form-content {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--primary-light);
            border-radius: 8px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group:last-child {
            margin-bottom: 0;
        }

        .input-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .input-field {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .competence-item, .loisir-item, .qualite-item {
            background: white;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .niveau-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            background: white;
        }

        .add-btn {
            background: var(--success);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .remove-btn {
            background: var(--error);
            color: white;
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            opacity: 0.9;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            padding: 1.5rem 2rem;
            background: var(--background);
            border-top: 1px solid var(--border);
        }

        .submit-btn, .cancel-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn {
            background: var(--primary);
            color: white;
            border: none;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .cancel-btn {
            background: white;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .cancel-btn:hover {
            background: var(--background);
        }

        .experience-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 640px) {
            .experience-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Saisie de CV</h1>
            <p>Remplissez les informations pour soumettre votre candidature</p>
        </div>
        <?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

        <form id="cvForm" action="<?php echo site_url('CV_Controller/submit_cv'); ?>" method="post">
        <input type="hidden" name="idAnnonce" value="<?php echo $idAnnonce; ?>">
            <div class="form-content">
                <!-- Section Compétences -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-code"></i>
                        Compétences
                    </h2>
                    <div id="competences-container">
                        <div class="competence-item">
                            <div class="input-group">
                                <label class="input-label">Description</label>
                                <textarea class="input-field" name="competence_description[]" rows="3" required></textarea>
                            </div>
                            <div class="input-group">
                                <label class="input-label">Niveau</label>
                                <select class="niveau-select" name="competence_niveau[]" required>
                                    <option value="">Sélectionnez un niveau</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Avancé">Avancé</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Loisirs -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-heart"></i>
                        Loisirs
                    </h2>
                    <div id="loisirs-container">
                        <div class="loisir-item">
                            <div class="input-group">
                                <label class="input-label">Description</label>
                                <input type="text" class="input-field" name="loisir_description[]" required>
                            </div>
                        </div>
                    </div>

                </div>

               <!-- Section Qualités -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="fas fa-star"></i>
                    Qualités
                </h2>
                
                <!-- Boucle pour chaque profil requis -->
                <!-- Section Qualités -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="fas fa-star"></i>
                    Qualités
                </h2>

                <div id="qualites-container">
                    <div class="qualite-item">
                        <div class="input-group">
                            <label class="input-label">Sélectionner le Profil</label>
                            
                            <?php if (isset($profilRequis) && is_array($profilRequis)) : ?>
                                <select class="input-field" name="idprofil[]" required>
                                    <?php foreach ($profilRequis as $profil) : ?>
                                        <option value="<?= htmlspecialchars($profil->id); ?>">
                                            <?= htmlspecialchars($profil->nomprofil); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <p>Aucun profil requis trouvé.</p>
                            <?php endif; ?>
                        </div>

                        <div class="input-group">
                            <label class="input-label">Nom de la Qualité</label>
                            <input type="text" class="input-field" name="qualite_nom[]" required>
                        </div>

                        <div class="experience-group">
                            <div class="input-group">
                                <label class="input-label">Expérience technique (années)</label>
                                <input type="number" class="input-field" name="experience_technique[]" min="0" required>
                            </div>
                            <div class="input-group">
                                <label class="input-label">Expérience générale (années)</label>
                                <input type="number" class="input-field" name="experience_generale[]" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Champ caché pour l'ID de l'annonce -->
            <input type="hidden" name="idAnnonce" value="<?= htmlspecialchars($idAnnonce); ?>">

                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="cancel-btn" onclick="cancel()">Annuler</button>
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i>
                                Soumettre le CV
                            </button>
                        </div>
                    </form>
                </div>
    <script>
        function submitForm(event) {
            event.preventDefault();
            // Ici, ajoutez votre logique pour traiter le formulaire
            const formData = new FormData(event.target);
            console.log('Soumission du formulaire', formData);
            // Exemple : envoi vers le serveur
            // fetch('/api/cv', {
            //     method: 'POST',
            //     body: formData
            // });
        }

        function cancel() {
            if(confirm('Voulez-vous vraiment annuler ? Toutes les données saisies seront perdues.')) {
                window.location.href = '/'; 
            }
        }
    </script>
</body>
</html>