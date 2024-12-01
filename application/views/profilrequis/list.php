<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>List - Profile</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/list.css'); ?>" >
<body>
<h1>Liste des profile</h1>
<p>
    <a href='<?php echo site_url("profilrequis_Controller/create/"); ?>'  class="add-button">
        Ajouter un nouveau  profile
    </a>
</p>
<div class="table-container">
<table>
    <tr>
        <th>Id</th>
        <th>Poste</th>
        <th>Profil</th>
        <th>Description</th>
        <th>Experience Technique</th>
        <th>experienceGenerale</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($profilrequis as $item): ?>
    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->nomposte; ?></td>
        <td><?php echo $item->nomprofil; ?></td>
        <td><?php echo $item->description; ?></td>
        <td><?php echo $item->experiencetechnique; ?></td>
        <td><?php echo $item->experiencegenerale; ?></td>
        <td>
            <a href='<?php echo site_url("profilrequis_Controller/edit/" . $item->id); ?>' class="btn btn-edit">Edit</a> |
            <a href='<?php echo site_url("profilrequis_Controller/delete/" . $item->id); ?>' class="btn btn-delete">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>
