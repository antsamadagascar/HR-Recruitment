<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des Besoins en Talent</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="<?php echo site_url('template/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --success: #059669;
            --danger: #dc2626;
            --warning: #d97706;
            --background: #f3f4f6;
            --card: #ffffff;
            --text: #1f2937;
            --border: #e5e7eb;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.5;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), #1e40af);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .card {
            background: var(--card);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            background: white;
        }

        .custom-table {
            margin: 0;
        }

        .custom-table thead th {
            background: #f8fafc;
            border-bottom: 2px solid var(--border);
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .custom-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-accept {
            background-color: var(--success);
            color: white;
            border: none;
        }

        .btn-accept:hover {
            background-color: #047857;
            color: white;
            transform: translateY(-1px);
        }

        .btn-reject {
            background-color: var(--danger);
            color: white;
            border: none;
        }

        .btn-reject:hover {
            background-color: #b91c1c;
            color: white;
            transform: translateY(-1px);
        }

        .action-column {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #9ca3af;
        }

        .floating-alert {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
            min-width: 300px;
            padding: 1rem;
            border-radius: 0.5rem;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: none;
        }

        @media (max-width: 768px) {
            .action-column {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">
                <i class="fas fa-check-circle me-2"></i>
                Validation des Besoins en Talent
            </h1>
            <p class="page-subtitle">
                Gérez et validez les demandes de recrutement
            </p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="card">
            <?php if(!empty($besoins_en_talent)): ?>
            <div class="table-container">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-briefcase me-2"></i>Poste</th>
                            <th><i class="fas fa-user-tie me-2"></i>Profil</th>
                            <th><i class="fas fa-align-left me-2"></i>Description</th>
                            <th><i class="fas fa-users me-2"></i>Postes</th>
                            <th><i class="fas fa-code me-2"></i>Exp. Technique</th>
                            <th><i class="fas fa-chart-line me-2"></i>Exp. Générale</th>
                            <th><i class="fas fa-calendar me-2"></i>Date</th>
                            <th class="text-end"><i class="fas fa-cogs me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($besoins_en_talent as $besoin): ?>
                        <tr>
                            <td>
                                <strong><?php echo $besoin->nomposte; ?></strong>
                            </td>
                            <td><?php echo $besoin->nomprofil; ?></td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="<?php echo $besoin->profil_description; ?>">
                                    <?php echo $besoin->profil_description; ?>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge bg-primary bg-opacity-10 text-primary">
                                    <?php echo $besoin->nombredepostes; ?>
                                </span>
                            </td>
                            <td><?php echo $besoin->experiencetechnique; ?></td>
                            <td><?php echo $besoin->experiencegenerale; ?></td>
                            <td>
                                <span class="status-badge bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-clock"></i>
                                    <?php echo date('d/m/Y', strtotime($besoin->datebesoin)); ?>
                                </span>
                            </td>
                            <td class="action-column">
                                <button class="btn btn-accept" onclick="confirmerAction('accepter', <?php echo $besoin->besoin_id; ?>)">
                                    <i class="fas fa-check"></i>
                                    Accepter
                                </button>
                                <button class="btn btn-reject" onclick="confirmerAction('refuser', <?php echo $besoin->besoin_id; ?>)">
                                    <i class="fas fa-times"></i>
                                    Refuser
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-check empty-state-icon"></i>
                <h3>Aucune demande en attente</h3>
                <p>Il n'y a actuellement aucune demande de besoin en talent à valider.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="floating-alert" id="alertBox">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <span id="alertMessage"></span>
        </div>
    </div>

    <script src="<?php echo site_url('template/assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        function showAlert(message, type = 'info') {
            const alertBox = document.getElementById('alertBox');
            const alertMessage = document.getElementById('alertMessage');
            
            alertBox.className = `floating-alert alert alert-${type}`;
            alertMessage.textContent = message;
            alertBox.style.display = 'block';
            
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }

        function confirmerAction(type, id) {
            let message = type === 'accepter' 
                ? 'Êtes-vous sûr de vouloir accepter ce besoin et envoyer une demande d\'annonce au Responsable Communication ?'
                : 'Êtes-vous sûr de vouloir refuser ce besoin ?';
            
            if (confirm(message)) {
                let url = type === 'accepter'
                    ? '<?php echo site_url('demande_controller/traiter_besoin' ); ?>/' + id
                    : '<?php echo site_url('demande_controller/refuse_besoin'); ?>/' + id;
                
                showAlert('Traitement en cours...', 'info');
                window.location.href = url;
            }
        }

        <?php if(isset($success_message)): ?>
            showAlert("<?php echo $success_message; ?>", 'success');
        <?php endif; ?>
        
        <?php if(isset($error_message)): ?>
            showAlert("<?php echo $error_message; ?>", 'danger');
        <?php endif; ?>
    </script>
</body>
</html>