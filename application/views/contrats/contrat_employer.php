<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>

        .container {
            max-width: 1300px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }


        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
        }

        .content {
            padding: 30px;
            overflow-x: auto;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: 20px;
        }

        th {
            background: #f8f9fa;
            color: #2d3748;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 16px;
            background: white;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        tr td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        tr td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        tbody tr {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .badge i {
            margin-right: 6px;
            font-size: 12px;
        }

        .badge-cdi {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #1a4731;
        }

        .badge-cdd {
            background: linear-gradient(135deg, #ffd1ff 0%, #fad0c4 100%);
            color: #742a2a;
        }

        .badge-stage {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            color: #2a4365;
        }

        .salary {
            font-weight: 600;
            color: #2d3748;
        }

        .date {
            color: #718096;
            font-size: 14px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #718096;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }
            
            td, th {
                padding: 12px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Affichage du message de succès ou d'erreur -->
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
            <h1><i class="fas fa-briefcase"></i> Mes Contrats</h1>
        </div>
        <div class="content">
            <?php if(!empty($contrat)): ?>
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-file-signature stat-icon"></i>
                    <h3>Total Contrats</h3>
                    <p><?php echo count($contrat); ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-check stat-icon"></i>
                    <h3>Contrats Actifs</h3>
                    <p><?php 
                        $actifs = array_filter($contrat, function($c) {
                            return strtotime($c->datedebutembauche) > time() || empty($c->datedebutembauche);
                        });
                        echo count($actifs);
                    ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-money-bill-wave stat-icon"></i>
                    <h3>Dernier Salaire</h3>
                    <p><?php 
                        if(!empty($contrat)) {
                            echo number_format(end($contrat)->salaire, 0, ',', ' ') . ' €';
                        } else {
                            echo "N/A";
                        }
                    ?></p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Informations</th>
                        <th>Type</th>
                        <th>Poste</th>
                        <th>Période</th>
                        <th>Salaire</th>
                        <th>statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contrat as $c): ?>
                    <tr>
                        <td>#<?php echo $c->idembauche; ?></td>
                        <td>
                            <div style="font-weight: 600;"><?php echo $c->nomcandidat . ' ' . $c->prenomcandidat; ?></div>
                            <div style="color: #718096; font-size: 13px;">ID: #<?php echo $c->idcandidat; ?></div>
                        </td>
                        <td>
                            <?php 
                            $badgeClass = '';
                            $icon = '';
                            switch(strtolower($c->typecontrat)) {
                                case 'cdi':
                                    $badgeClass = 'badge-cdi';
                                    $icon = 'infinity';
                                    break;
                                case 'cdd':
                                    $badgeClass = 'badge-cdd';
                                    $icon = 'clock';
                                    break;
                                default:
                                    $badgeClass = 'badge-stage';
                                    $icon = 'graduation-cap';
                            }
                            ?>
                            <span class="badge <?php echo $badgeClass; ?>">
                                <i class="fas fa-<?php echo $icon; ?>"></i>
                                <?php echo $c->typecontrat; ?>
                            </span>
                        </td>
                        <td><?php echo $c->nomcontrat; ?></td>
                        <td>
                            <div class="date">Début: <?php echo date('d/m/Y', strtotime($c->datedebutembauche)); ?></div>
                            <div class="date">Fin: <?php echo empty($c->datefinembauche) ? 'Indéterminée' : date('d/m/Y', strtotime($c->datefinembauche)); ?></div>
                        </td>
                        <td class="salary"><?php echo number_format($c->salaire, 0, ',', ' '); ?> €/an</td>
                      
                    <td>
                    <!-- Afficher le statut -->
                    <?php 
                    if ($c->iscontrat == "t") {
                        echo 'Accepté'; // Si le contrat est validé
                    } else {
                        echo 'En attente'; // Si le contrat est en attente
                    }
                    ?>
                    </td>
                    <td>
                    <!-- <?php if ($c->iscontrat == 'f'): true ?> -->

                <form action="<?php echo site_url('Embauche_Controller/update_contrat_candidat'); ?>" method="POST" style="display:inline;">
                    <!-- Utilisation de la syntaxe c-<id> pour l'ID -->
                    <input type="hidden" name="idembauche" value="<?php echo $c->idembauche; ?>">
                    <button type="submit" name="action" value="valider" class="btn btn-success">Valider</button>
                </form>
                <form action="<?php echo site_url('Embauche_Controller/update_contrat_candidat'); ?>" method="POST" style="display:inline;">
                    <!-- Utilisation de la syntaxe c-<id> pour l'ID -->
                    <input type="hidden" name="idembauche" value="c-<?php echo $c->idembauche; ?>">
                    <button type="submit" name="action" value="refuser" class="btn btn-danger">Refuser</button>
                   </form>
                <?php endif; ?>

                </td>
                    </tr>
         
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-data">
                <i class="fas fa-folder-open" style="font-size: 48px; color: #cbd5e0; margin-bottom: 20px;"></i>
                <p>Aucun contrat pour l'instant.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>