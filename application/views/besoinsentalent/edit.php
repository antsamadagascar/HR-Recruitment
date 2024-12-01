<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit - Besoin_Talent</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Modifier un besoin_talent</h1>
    </div>
<form action='<?php echo site_url("BesoinsEnTalent_Controller/edit/" . $item->id); ?>' method='post'>
    <input type='hidden' name='id' value='<?php echo $item->id; ?>'>
   
    <select name="idprofile" class="select-besoin" required>
    <option value="">Sélectionnez un besoin de talent</option>
    <?php foreach ($profilrequis as $profil): ?>
        <option value="<?php echo $profil->id; ?>" 
            <?php echo ($profil->id == $item->idprofile) ? 'selected' : ''; ?>>
            <?php echo $profil->nomprofil; ?>
        </option>
    <?php endforeach; ?>
</select>

    
    <label for='date_besoin'>Date_besoin:</label>
    <input type='date' id='date_besoin' name='datebesoin' value='<?php echo $item->datebesoin; ?>' required>
    
    <label for='nombredepostes'>Nombre de Poste:</label>
    <input type='number' id='nombredepostes' name='nombredepostes' value='<?php echo $item->nombredepostes; ?>' required>
    
    <button type='submit' class="btn btn-primary">Update</button>
</form>
            </div>
<p><a href='<?php echo site_url("BesoinsEnTalent_Controller"); ?>' >Retour </p>