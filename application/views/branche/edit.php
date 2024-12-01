<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit - Branche</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>
<div class="container">
    <div class="header">
        <h1>Modifier un branche</h1>
    </div>
<form action='<?php echo site_url("branche_Controller/edit/" . $item->id); ?>' method='post'>
    <input type='hidden' name='id' value='<?php echo $item->id; ?>'>
    <label for='nom'>Nom:</label>
    <input type='text' id='nombranche' name='nombranche' value='<?php echo $item->nombranche; ?>' required>
    <button type='submit '  class="btn btn-primary"> Update</button>
</form>
<p><a href='<?php echo site_url("branche_Controller"); ?>'>Retour </p>