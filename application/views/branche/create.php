<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Create - Branche</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Ajouter une branche</h1>
    </div>
<form action='<?php echo site_url("branche_Controller/create"); ?>' method='post'>
    <label for='nom'>Nom:</label>
    <input type='text' id='nom' name='nombranche' required>
    <button type='submit' class="btn btn-primary">Soumettre</button>
</form>
</div>