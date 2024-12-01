<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Demande Besoin</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Demande Besoin</h1>
    </div>
<form action='<?php echo site_url("BesoinsEnTalent_Controller/create"); ?>' method='post'>
    <label for='nomprofil'>Profil:</label>
    <select name='idprofile'  class="select-besoin" required>
            <option value="">Sélectionnez un besoin de talent</option>
            <?php foreach ($profilrequis as $profilrequi): ?>
                <option value='<?php echo $profilrequi->id; ?>'><?php echo $profilrequi->nomprofil; ?></option>
            <?php endforeach; ?>
    </select>

    <label for='date_besoin'>Date_besoin:</label>
    <input type='date' id='date_besoin' name='datebesoin' required>
    
    <label for='nombredepostes'>Nombre de Poste:</label>
    <input type='number' id='nombredepostes' name='nombredepostes' required>
    <input type="hidden" name="status" value="0"> <!-- 0 signifie "en attente" -->

    
    
    <button type='submit' class="btn btn-primary">Envoyer la Demande Aux RH</button>
</form>
</div>
