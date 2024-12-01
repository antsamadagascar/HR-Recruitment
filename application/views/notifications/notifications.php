<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f2ff 0%, #f5f7fa 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .notifications {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .notification {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            animation: slideIn 0.3s ease-out;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .notification::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .date {
            font-size: 13px;
            color: #718096;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .message {
            color: #4a5568;
            line-height: 1.5;
            margin-left: 10px;
        }

        .no-notifications {
            background: white;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            color: #718096;
        }

        .no-notifications i {
            font-size: 48px;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .mark-all-read {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease;
        }

        .mark-all-read:hover {
            transform: scale(1.05);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
        }

        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .header h1 {
                justify-content: center;
            }

            .notification {
                padding: 15px;
            }

            .notification-header {
                flex-direction: column;
                gap: 10px;
            }

            .date {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-bell" style="color: #667eea;"></i>
                Mes Notifications
            </h1>
            <?php if(!empty($notifications)): ?>
            <div style="display: flex; gap: 15px; align-items: center;">
                <span class="notification-count">
                    <i class="fas fa-envelope"></i>
                    <?php echo count($notifications); ?> notifications
                </span>
                <button class="mark-all-read" onclick="markAllRead()">
                    <i class="fas fa-check-double"></i>
                    Tout marquer comme lu
                </button>

            </div>
            <?php endif; ?>
        </div>

        <div class="notifications">
            <?php if(!empty($notifications)): ?>
                <?php foreach($notifications as $notif): ?>
                    <div class="notification">
                        <div class="notification-header">
                            <div class="notification-content">
                                <div class="notification-icon">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div>
                                    <div class="message"><?php echo $notif['message']; ?></div>
                                    <div class="date">
                                        <i class="far fa-clock"></i>
                                        <?php 
                                            $date = new DateTime($notif['datenotification']);
                                            echo $date->format('Y-m-d H:i:s');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <p>Vous n'avez aucune notification pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
    function markAllRead() {
        if (confirm('Voulez-vous vraiment marquer toutes les notifications comme lues ?')) {
            window.location.href = '<?php echo site_url("Notifications_Controller/mark_all_read"); ?>';
        }
    }
</script>

</body>
</html>