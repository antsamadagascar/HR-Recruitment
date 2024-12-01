<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de CV</title>
</head>
<style>
.message-container {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    font-size: 16px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.btn-primary {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background-color: #007bff;
    border-radius: 4px;
    text-decoration: none;
}
</style>
<body>
    <div class="message-container">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <a href="<?= base_url('Home_Controller/dashboard'); ?>" class="btn btn-primary">Retour à la liste des annonces</a>
    </div>
</body>
</html>
