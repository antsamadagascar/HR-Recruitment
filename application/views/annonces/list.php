<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Annonces</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f3f4f6;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            color: #111827;
        }

        /* Boutons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        /* Cards des annonces */
        .job-cards {
            display: grid;
            gap: 1rem;
        }

        .job-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .job-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .job-card-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .job-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .job-info {
            display: flex;
            gap: 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .job-info span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .job-tags {
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .tag {
            display: inline-flex;
            padding: 0.25rem 0.75rem;
            background-color: #dbeafe;
            color: #1e40af;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .edit-btn {
            color: #4b5563;
        }

        .edit-btn:hover {
            background-color: #f3f4f6;
        }

        .delete-btn {
            color: #dc2626;
        }

        .delete-btn:hover {
            background-color: #fee2e2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Liste des Annonces Actives</h1>
            <a href='<?php echo site_url("Annonce/create/"); ?>' class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouvelle Annonce
            </a>
        </div>

        <div class="job-cards">
            <?php foreach ($annonce as $item): ?>
            <div class="job-card">
                <div class="job-card-header">
                    <div>
                        <h2 class="job-title"><?php echo $item->annonce_titre; ?></h2>
                        <div class="job-info">
                            <span><i class="fas fa-calendar"></i> <?php echo $item->annonce_date_debut; ?> - <?php echo $item->datefin; ?></span>
                            <span><i class="fas fa-briefcase"></i> <?php echo $item->nomprofil; ?></span>
              
                        </div>
                    </div>
                    <div class="actions">
                        <a href='<?php echo site_url("Annonce/edit/" . $item->annonce_id); ?>' class="action-btn edit-btn">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href='<?php echo site_url("Annonce/delete/" . $item->annonce_id); ?>' class="action-btn delete-btn" onclick="alert('voulez vous vraiement le supprimer?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="job-tags">
                    <span class="tag"><?php echo $item->description; ?></span>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>