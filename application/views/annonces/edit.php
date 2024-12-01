<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Annonce</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<link rel="stylesheet" href="<?php echo site_url('template/assets/css/form.css'); ?>"> 
<body>

<div class="container">
    <div class="header">
        <h1>Modifier une Annonce</h1>
    </div>
    
    <form action='<?php echo site_url("Annonce/edit/" . $item->id); ?>' method='post'>
        <input type='hidden' name='id' value='<?php echo $item->id; ?>'>

        <label for='titre'>Titre:</label>
        <input type='text' id='titre' name='titre' value='<?php echo $item->titre; ?>' required>

        <label for='description'>description:</label>
        <input type='text' id='description' name='description' value='<?php echo $item->description; ?>' required>

        <label for='date_debut'>Date de début:</label>
        <input type='date' id='datedebut' name='datedebut' value='<?php echo $item->datedebut; ?>' required>

        <label for='date_fin'>Date de fin:</label>
        <input type='date' id='datefin' name='datefin' value='<?php echo $item->datefin; ?>' required>

        <label for='idbesoinentalent'>Besoin de Talent:</label>
        <select id="idbesoinentalent" name="idbesoinentalent" class="select-besoin" required>
        <option value="">Sélectionnez un besoin de talent</option>
        <?php foreach ($besoin_talents as $besoin): ?>
            <option value="<?php echo $besoin->id; ?>"
                <?php echo $besoin->id == $item->idbesoinentalent ? 'selected' : ''; ?>>
                <?php echo $besoin->id . ' - ' . $besoin->nomprofil; ?>
            </option>
            <?php endforeach; ?>
        </select>

    
        <button type='submit' class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

</body>
</html>
