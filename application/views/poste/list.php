<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>List - Poste</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/list.css'); ?>"> 
<body>
<h1>Liste des poste</h1>
<p><a href='<?php echo site_url("poste_Controller/create/"); ?>' class="add-button" >Ajouter un nouveau  poste</a></p>
<div class="table-container">
<table>
    <tr>
        <th>Id</th>
        <th>Branche</th>
        <th>Poste</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($poste as $item): ?>
    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->nombranche; ?></td>
        <td><?php echo $item->nomposte; ?></td>
        <td><?php echo $item->description; ?></td>
        <td>
            <a href='<?php echo site_url("poste_Controller/edit/" . $item->id); ?>' class="btn btn-edit">Edit</a> |
            <a href='<?php echo site_url("poste_Controller/delete/" . $item->id); ?>' class="btn btn-delete">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
    </div>
</body>
</html>
