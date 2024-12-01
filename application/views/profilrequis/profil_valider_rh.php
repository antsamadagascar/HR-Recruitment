<div class="container mt-4">
    <h1 class="text-center">Profils Validés par le RH</h1>

    <?php if (!empty($profilCandidats)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Qualité Requise</th>
                    <th>Compétence</th>
                    <th>Profil Requis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profilCandidats as $profil): ?>
                    <tr>
                        <td><?= htmlspecialchars($profil->nom_candidat) ?></td>
                        <td><?= htmlspecialchars($profil->prenom_candidat) ?></td>
                        <td><?= htmlspecialchars($profil->qualite_requise) ?></td>
                        <td><?= htmlspecialchars($profil->competence_description) ?> (<?= htmlspecialchars($profil->competence_niveau) ?>)</td>
                        <td><?= htmlspecialchars($profil->profil_requis) ?></td>
                        <td>
                            <button 
                                class="btn btn-success btn-sm" 
                                onclick="handleAccept(<?= htmlspecialchars($profil->candidat_id) ?>)">
                                Accepter
                            </button>
                            <button 
                                class="btn btn-danger btn-sm" 
                                onclick="handleReject(<?= htmlspecialchars($profil->candidat_id) ?>)">
                                Refuser
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Aucun profil validé par le RH trouvé.</p>
    <?php endif; ?>
</div>

<script>
    function handleAccept(candidatId) {
    if (confirm("Êtes-vous sûr d'accepter ce candidat ?")) {
        fetch('<?= site_url("CV_Controller/validerCv") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ candidatId: candidatId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat accepté avec succès !Le Responsable de communication sera notifier pour dire aux candidats de passer aux Test!");
                location.reload(); 
            } else {
                alert("Erreur lors de l'acceptation du candidat.");
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite.");
        });
    }
}

function handleReject(candidatId) {
    if (confirm("Êtes-vous sûr de refuser ce candidat ?")) {
        fetch('<?= site_url("CV_Controller/refuserCv") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ candidatId: candidatId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Candidat refusé avec succès !");
                location.reload();
            } else {
                alert("Erreur lors du refus du candidat.");
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite.");
        });
    }
}

</script>
