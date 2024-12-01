<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des annonces validées par le RH</title>
   
</head>
<body>
    <div class="container mt-5">
        <h2>Liste des annonces validées par le RH</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du poste</th>
                    <th>Nom du profil</th>
                    <th>Description</th>
                    <th>Date du besoin</th>
                    <th>Nombre de postes</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($annonces)): ?>
                    <?php foreach ($annonces as $annonce): ?>
                        <tr>
                            <td><?php echo $annonce->besoin_id; ?></td>
                            <td><?php echo $annonce->nomPoste; ?></td>
                            <td><?php echo $annonce->nomProfil; ?></td>
                            <td><?php echo $annonce->profil_description; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($annonce->dateBesoin)); ?></td>
                            <td><?php echo $annonce->nombreDePostes; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucune annonce validée par le RH</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
