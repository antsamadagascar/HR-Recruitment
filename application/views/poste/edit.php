<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit - Poste</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>">  
<body>
<div class="container">
    <div class="header">
        <h1>Modifier une Poste</h1>
    </div>
<form action='<?php echo site_url("poste_Controller/edit/" . $item->id); ?>' method='post'>
    <input type='hidden' name='id' value='<?php echo $item->id; ?>'>
    <label for='Branche'>Branche:</label>    
    <select id="idbranche" name="idbranche" class="select-besoin" required>
    <option value="">Sélectionnez une Branche</option>
    <?php foreach ($branches as $branche): ?>
        <option value="<?php echo $branche->id; ?>" 
            <?php echo ($branche->id == $item->idbranche) ? 'selected' : ''; ?>>
            <?php echo $branche->nombranche; ?>
        </option>
    <?php endforeach; ?>
</select>

    
    <label for='nomposte'>Poste:</label>
    <input type='text' id='nomposte' name='nomposte' value='<?php echo $item->nomposte; ?>' required>
    <label for='description'>Description:</label>
    <input type='text' id='poste' name='description' value='<?php echo $item->description; ?>' required>
    <button type='submit'  class="btn btn-primary">Update</button>
</form>
<p><a href='<?php echo site_url("poste_Controller"); ?>'>Retour </p>