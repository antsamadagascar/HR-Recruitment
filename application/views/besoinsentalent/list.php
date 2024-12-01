<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>List - Besoin_Talent</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/list.css'); ?>"> 
<body>
    <h1>Liste des besoin_talent</h1>
    
    <a href='<?php echo site_url("BesoinsEnTalent_Controller/create/"); ?>' class="add-button">
        Ajouter un nouveau besoin_talent
    </a>

    <div class="table-container">
        <table>
            <tr>
                <th>Id</th>
                <th>Profil</th>
                <th>Nombre De Poste</th>
                <th>Date_besoin</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($besoinsentalent as $item): ?>
            <tr>
                <td><?php echo $item->id ; ?></td>
                <td><?php echo $item->nomprofil ; ?></td>
                <td><?php echo $item->nombredepostes; ?></td>
                <td><?php echo $item->datebesoin; ?></td>
                <td class="actions">
                    <a href='<?php echo site_url("BesoinsEnTalent_Controller/edit/" . $item->id); ?>' class="btn btn-edit">Modifier</a>
                    <a href='<?php echo site_url("BesoinsEnTalent_Controller/delete/" . $item->id); ?>' class="btn btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>