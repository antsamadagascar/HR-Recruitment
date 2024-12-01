<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Demande  Congés </title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <!-- Check if there are flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>
    <div class="header">
        <h1>Demande  Congés</h1>
    </div>
<form action='<?php echo site_url("Conge_controller/demande"); ?>' method='post'>   
<input type='hidden' id='idemploye' name='idemploye' value="<?php echo $idemploye; ?>" required>

<label for='TypeConge'>Type Congés:</label>
    <select id="typeConge" name="idtypeconge" class="select-besoin" required>
        <option value="">Sélectionnez le type de Congés </option>
        <?php foreach ($typeConge as $typeConge): ?>
            <option value="<?php echo $typeConge->id; ?>"
                <?php echo $typeConge->id == $typeConge->id ? 'selected' : ''; ?>>
                <?php echo $typeConge->id . ' - ' . $typeConge->nom; ?>
            </option>
            <?php endforeach; ?>
    </select>
 
    <label for='nom'>Date Debut:</label>
        <input type='date' id='datedebut' name='datedebut' required>

    <label for='nom'>Date Fin:</label>
        <input type='date' id='datefin' name='datefin' required>
    
    <label for='nom'>Nombre de Jours(J):</label>
        <input type='number' id='nombrejours' name='nbrjours' required>
    
    <label for='nom'>motif:</label>
        <input type='text' id='motif' name='motif' required>

    <button type='submit' class="btn btn-primary">Soumettre</button>
</form>
</div>