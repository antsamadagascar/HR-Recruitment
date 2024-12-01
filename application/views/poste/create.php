<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Create - Poste</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>">  
<div class="container">
    <div class="header">
        <h1>Ajouter une Poste</h1>
    </div>
<form action='<?php echo site_url("poste_Controller/create"); ?>' method='post'>
    <label for='Branche'>Branche:</label>    
    <select id='idbranche' name='idbranche'  class="select-besoin" required>
            <option value="">Sélectionnez un Branche</option>
            <?php foreach ($branches as $branche): ?>
                <option value='<?php echo $branche->id; ?>'><?php echo $branche->nombranche; ?></option>
            <?php endforeach; ?>
    </select>
    <label for='nomposte'>Nom Poste:</label>
    <input type='text' id='nomposte' name='nomposte' required>
    <label for='description'>Description:</label>
    <input type='text' id='description' name='description' required>
    <button type='submit'  class="btn btn-primary">Submit</button>
</form>
</div>
<p><a href='<?php echo site_url("poste_Controller"); ?>' >Retour </p>