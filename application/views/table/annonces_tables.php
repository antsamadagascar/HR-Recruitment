<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #4338ca;
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --background: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: var(--background);
            padding: 2rem;
            min-height: 100vh;
            line-height: 1.6;
        }

        .annonces-card {
            max-width: 1000px;
            margin: 0 auto 2rem;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .annonces-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .annonces-banner {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .banner-pattern {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.1;
            background-image: linear-gradient(45deg, #ffffff 25%, transparent 25%),
                            linear-gradient(-45deg, #ffffff 25%, transparent 25%),
                            linear-gradient(45deg, transparent 75%, #ffffff 75%),
                            linear-gradient(-45deg, transparent 75%, #ffffff 75%);
            background-size: 20px 20px;
        }

        .annonces-id-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            backdrop-filter: blur(4px);
        }

        .annonces-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
        }

        .header-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .content-section {
            padding: 2rem;
        }

        .section-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .info-block {
            margin-bottom: 2rem;
        }

        .info-block:last-child {
            margin-bottom: 0;
        }

        .block-title {
            font-size: 1.25rem;
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .block-title i {
            color: var(--primary-color);
        }

        .description-text {
            color: var(--text-secondary);
            font-size: 0.9375rem;
            background: var(--background);
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .details-card {
            background: var(--background);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .detail-value {
            color: var(--text-primary);
            font-weight: 500;
        }

        .dates-footer {
            background: var(--background);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
        }

        .date-group {
            display: flex;
            gap: 2rem;
        }

        .date-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .date-item i {
            color: var(--primary-color);
        }

        .postuler-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .postuler-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .postuler-btn:active {
            transform: translateY(0);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            background: var(--success-color);
            color: white;
        }

        @media (max-width: 768px) {
            .section-grid {
                grid-template-columns: 1fr;
            }

            .date-group {
                flex-direction: column;
                gap: 1rem;
            }

            .dates-footer {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="annonces-card">
        <div class="annonces-banner">
            <div class="banner-pattern"></div>
            <div class="annonces-id-badge">ID: <?php echo $annonces->idannonce; ?></div>
            <h1 class="annonces-title"><?php echo $annonces->titre; ?></h1>
            <div class="header-meta">
                <div class="meta-item">
                    <i class="fas fa-briefcase"></i>
                    <?php echo $annonces->nomposte; ?>
                </div>
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    <?php echo $annonces->nombranche; ?>
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-grid">
                <div class="main-content">
                    <div class="info-block">
                        <h2 class="block-title">
                            <i class="fas fa-info-circle"></i>
                            Description du poste
                        </h2>
                        <div class="description-text">
                            <?php echo $annonces->descriptionannonce; ?>
                        </div>
                    </div>

                    <div class="info-block">
                        <h2 class="block-title">
                            <i class="fas fa-user-tie"></i>
                            Profil recherché
                        </h2>
                        <div class="description-text">
                            <?php echo $annonces->descriptionprofil; ?>
                        </div>
                    </div>
                </div>

                <div class="side-content">
                    <div class="details-card">
                        <div class="detail-item">
                            <span class="detail-label">Profil</span>
                            <span class="detail-value"><?php echo $annonces->nomprofil; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Département</span>
                            <span class="detail-value"><?php echo $annonces->nombranche; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Postes disponibles</span>
                            <span class="status-badge">
                                <i class="fas fa-users"></i>
                                <?php echo $annonces->nombredepostes; ?>
                            </span>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 1.5rem;">
                        <button class="postuler-btn" onclick="postulerCV(<?php echo $annonces->idannonce; ?>)">
                            <i class="fas fa-paper-plane"></i>
                            Postuler mon CV
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="dates-footer">
            <div class="date-group">
                <div class="date-item">
                    <i class="far fa-calendar-alt"></i>
                    <span>Début: <?php echo date('d/m/Y', strtotime($annonces->datedebut)); ?></span>
                </div>
                <div class="date-item">
                    <i class="far fa-calendar-check"></i>
                    <span>Fin: <?php echo date('d/m/Y', strtotime($annonces->datefin)); ?></span>
                </div>
                <div class="date-item">
                    <i class="fas fa-hourglass-end"></i>
                    <span>Date limite: <?php echo date('d/m/Y', strtotime($annonces->datebesoin)); ?></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function postulerCV(annoncesId) {
            // Ici vous pouvez ajouter la logique pour gérer la soumission du CV
            // Par exemple, rediriger vers un formulaire de candidature
            alert('Redirection vers le formulaire de candidature pour l\'annonces ' + annoncesId);
            // window.location.href = '/postuler/' + annoncesId;
        }
    </script>
</body>
</html>