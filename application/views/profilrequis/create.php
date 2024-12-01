<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Create - Profile</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Ajouter une Profile</h1>
    </div>
<form action='<?php echo site_url("profilrequis_Controller/create"); ?>' method='post'>
<label for='nomposte'>Poste:</label> 
   <select id='poste' name='idposte'  class="select-besoin" required>
            <option value="">Sélectionnez un Poste</option>
            <?php foreach ($postes as $poste): ?>
                <option value='<?php echo $poste->id; ?>'><?php echo $poste->nomposte; ?></option>
            <?php endforeach; ?>
    </select>

    <label for='nomprofil'>Nom Profile:</label>
    <input type='text' id='nomprofil' name='nomprofil' required>

    <label for='description'>Description:</label>
    <input type='text' id='description' name='description' required>

    <label for='experiencetechnique'>Experience Technique:</label>
    <input type='number' id='experiencetechnique' name='experiencetechnique' required>

    <label for='experiencegenerale'>Experience Generale:</label>
    <input type='number' id='experiencegenerale' name='experiencegenerale' required>

    <button type='submit' class="btn btn-primary">Submit</button>
</form>
</div>
<p><a href='<?php echo site_url("profilrequis_Controller"); ?>'>Retour </p>