<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit - Profile</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Modifier une profile</h1>
    </div>
<form action='<?php echo site_url("profilrequis_Controller/edit/" . $item->id); ?>' method='post'>
    <input type='hidden' name='id' value='<?php echo $item->id; ?>'>
    <label for='nomposte'>Poste:</label> 
    <select id="idposte" name="idposte" class="select-besoin" required>
    <option value="">Sélectionnez un Poste</option>
        <?php foreach ($postes as $poste): ?>
            <option value="<?php echo $poste->id; ?>" 
                <?php echo ($poste->id == $item->idposte) ? 'selected' : ''; ?>>
                <?php echo $poste->nomposte; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for='nom'>Nom Profile:</label>
    <input type='text' id='nomprofil' name='nomprofil' value='<?php echo $item->nomprofil; ?>' required>

    <label for='description'>description:</label>
    <input type='text' id='description' name='description' value='<?php echo $item->description; ?>' required>

    <label for='experiencetechnique'>Experience Technique:</label>
    <input type='number' id='experiencetechnique' name='experiencetechnique' value='<?php echo $item->experiencetechnique; ?>' required>

    <label for='experiencegenerale'>Experience Generale:</label>
    <input type='number' id='experiencegenerale' name='experiencegenerale' value='<?php echo $item->experiencegenerale; ?>' required>


    <button type='submit' class="btn btn-primary">Update</button>
</form>
</div>
<p><a href='<?php echo site_url("profilrequis_Controller"); ?>'>Retour </p>