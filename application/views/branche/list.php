<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>List - Branche</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/list.css'); ?>"> 
<body>
<h1>Liste des branche</h1>
<p>
    <a href='<?php echo site_url("branche_Controller/create/"); ?>' class="add-button" >Ajouter un nouveau  branche</a>
</p>
<div class="table-container">
<table >
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($branche as $item): ?>
    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->nombranche; ?></td>
        <td>
            <a href='<?php echo site_url("branche_Controller/edit/" . $item->id); ?>' class="btn btn-edit">Modifier</a>
            <a href='<?php echo site_url("branche_Controller/delete/" . $item->id); ?>' class="btn btn-delete">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>
