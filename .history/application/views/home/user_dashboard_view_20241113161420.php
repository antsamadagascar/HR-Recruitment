<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Branche</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        .submit-button {
            background-color: #003366; /* Bleu marine */
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="#" method="post">
        <label for="branche">Branche concernée</label>
        <select id="branche" name="branche" required>
            <option value="" disabled selected>Choisir une branche</option>
            <option value="informatique">Informatique</option>
            <option value="gestion">Gestion</option>
            <option value="commerce">Commerce</option>
            <option value="sante">Santé</option>
            <option value="ingenierie">Ingénierie</option>
        </select>
        <button type="submit" class="submit-button">Submit</button>
    </form>
</div>

</body>
</html>
