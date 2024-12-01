
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système ATS - Gestion des Candidatures</title>
    <style>
        :root {
            --primary: #2563eb;
            --success: #16a34a;
            --warning: #ca8a04;
            --danger: #dc2626;
            --background: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background);
            color: #1f2937;
        }

        .dashboard {
            max-width: 1400px;
            margin: 0 auto;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 5px;
            color: #4b5563;
        }

        .filter-group select, .filter-group input {
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .candidates-grid {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }

        .candidate-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: grid;
            grid-template-columns: auto 120px;
            gap: 20px;
            transition: transform 0.2s;
        }

        .candidate-card:hover {
            transform: translateY(-2px);
        }

        .candidate-info h3 {
            margin: 0 0 10px 0;
            color: #1f2937;
        }

        .score-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 15px;
            display: inline-block;
        }

        .score-high {
            background-color: #dcfce7;
            color: var(--success);
        }

        .score-medium {
            background-color: #fef9c3;
            color: var(--warning);
        }

        .score-low {
            background-color: #fee2e2;
            color: var(--danger);
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .skill-tag {
            background: #e5e7eb;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .candidate-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: flex-start;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 0.875rem;
            text-align: center;
        }

        .btn-accept {
            background-color: var(--success);
            color: white;
        }

        .btn-reject {
            background-color: var(--danger);
            color: white;
        }

        .matching-details {
            margin-top: 10px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .progress-bar {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 3px;
            margin-top: 5px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
            background-color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="filters">
            <div class="filters-grid">
                <div class="filter-group">
                    <label for="score-filter">Score minimum</label>
                    <select id="score-filter">
                        <option value="0">Tous les scores</option>
                        <option value="75">75% et plus</option>
                        <option value="50">50% et plus</option>
                        <option value="25">25% et plus</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="experience-filter">Expérience</label>
                    <select id="experience-filter">
                        <option value="all">Toute expérience</option>
                        <option value="junior">Junior (0-2 ans)</option>
                        <option value="intermediate">Intermédiaire (3-5 ans)</option>
                        <option value="senior">Senior (5+ ans)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="competence-filter">Compétence</label>
                    <input type="text" id="competence-filter" placeholder="Filtrer par compétence">
                </div>
            </div>
        </div>

        <div class="candidates-grid" id="candidates-container">
            <!-- Dans votre fichier profil_recrutement.php -->
    <?php foreach ($profilCandidats as $candidat): 
        // Trouver le profil requis correspondant
        $profilRequisCorrespondant = null;
        foreach ($profilRequis as $profil) {
            if ($profil['profil_requis'] === $candidat['profil_requis']) {
                $profilRequisCorrespondant = $profil;
                break;
            }
        }
        
        // Calculer le score seulement si on a trouvé le profil requis correspondant
        $score = $profilRequisCorrespondant ? calculateATSScore($candidat, $profilRequisCorrespondant) : 0;
    ?>
    <div class="candidate-card" data-score="<?= $score ?>">
        <div class="candidate-info">
            <h3><?= $candidat['nom_candidat'] ?> <?= $candidat['prenom_candidat'] ?></h3>
            <div class="score-badge <?= getScoreClass($score) ?>">
                Score ATS: <?= $score ?>%
            </div>
            <div class="matching-details">
                <div>Expérience technique: <?= $candidat['qualite_experience_technique'] ?></div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?= $profilRequisCorrespondant ? 
                        (calculateExperienceMatch($candidat['qualite_experience_technique'], 
                        $profilRequisCorrespondant['experience_technique_requise']) * 100) : 0 ?>%">
                    </div>
                </div>
            </div>
            <div class="skills-list">
                <?php 
                $competences = explode(',', $candidat['competence_description']);
                foreach ($competences as $skill): ?>
                    <span class="skill-tag"><?= trim($skill) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="candidate-actions">
            <button class="btn btn-accept" onclick="handleAccept(<?= $candidat['candidat_id'] ?>)">Accepter</button>
            <button class="btn btn-reject" onclick="handleReject(<?= $candidat['candidat_id'] ?>)">Refuser</button>
        </div>
    </div>
    <?php endforeach; ?>
                            
        </div>
    </div>

    <script>
        function calculateATSScore(candidat, profilRequis) {
            // Algorithme de scoring
            let score = 0;
            const weights = {
                competences: 0.4,
                experienceTechnique: 0.3,
                experienceGenerale: 0.3
            };

            // Score des compétences
            const competencesRequises = profilRequis.qualite_requise.split(',').map(c => c.trim().toLowerCase());
            const competencesCandidat = candidat.competence_description.split(',').map(c => c.trim().toLowerCase());
            const competencesMatch = competencesCandidat.filter(c => competencesRequises.includes(c)).length / competencesRequises.length;
            
            // Score de l'expérience
            const expTechMatch = calculateExperienceMatch(candidat.qualite_experience_technique, profilRequis.experience_technique_requise);
            const expGenMatch = calculateExperienceMatch(candidat.qualite_experience_generale, profilRequis.experience_generale_requise);

            score = (competencesMatch * weights.competences) + 
                    (expTechMatch * weights.experienceTechnique) + 
                    (expGenMatch * weights.experienceGenerale);

            return Math.round(score * 100);
        }

        function calculateExperienceMatch(candidatExp, requisExp) {
            // Conversion en années
            const candidatYears = parseInt(candidatExp);
            const requisYears = parseInt(requisExp);
            
            if (candidatYears >= requisYears) return 1;
            return candidatYears / requisYears;
        }

        function getScoreClass(score) {
            if (score >= 75) return 'score-high';
            if (score >= 50) return 'score-medium';
            return 'score-low';
        }

        // Filtrage des candidats
        document.getElementById('score-filter').addEventListener('change', filterCandidates);
        document.getElementById('experience-filter').addEventListener('change', filterCandidates);
        document.getElementById('competence-filter').addEventListener('input', filterCandidates);

        function filterCandidates() {
            const scoreMin = parseInt(document.getElementById('score-filter').value);
            const experienceFilter = document.getElementById('experience-filter').value;
            const competenceFilter = document.getElementById('competence-filter').value.toLowerCase();

            const cards = document.querySelectorAll('.candidate-card');
            cards.forEach(card => {
                const score = parseInt(card.dataset.score);
                const skills = Array.from(card.querySelectorAll('.skill-tag')).map(tag => tag.textContent.toLowerCase());
                const experience = card.querySelector('.matching-details').textContent.toLowerCase();

                const matchesScore = score >= scoreMin;
                const matchesExperience = experienceFilter === 'all' || experience.includes(experienceFilter);
                const matchesCompetence = competenceFilter === '' || skills.some(skill => skill.includes(competenceFilter));

                card.style.display = matchesScore && matchesExperience && matchesCompetence ? 'grid' : 'none';
            });
        }

        function handleAccept(candidatId) {
    if (confirm("Êtes-vous sûr d'accepter ce candidat ?")) {
        fetch('<?= site_url("Candidature_Controller/updateCandidatStatus"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                candidatId: candidatId,
                status: 'accepter'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat accepté avec succès!");
                location.reload();
            } else {
                alert("Erreur: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
          //  alert("Une erreur s'est produite lors de l'acceptation du candidat.");
        });
    }
}

function handleReject(candidatId) {
    if (confirm("Êtes-vous sûr de refuser ce candidat ?")) {
        fetch('<?= site_url("Candidature_Controller/updateCandidatStatus"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                candidatId: candidatId,
                status: 'rejeter'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat refusé avec succès!");
                location.reload();
            } else {
               // alert("Erreur: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
          //  alert("Une erreur s'est produite lors du refus du candidat.");
        });
    }
}
    </script>
</body>
</html>