<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact ATS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif; ?>
        <h3 class="text-center">Envoyez-nous un message</h3>
        <p class="text-muted text-center">Nous sommes à votre écoute !</p>
        <div id="feedback-message"></div>

        <form id="contactForm" method="POST" action="<?= site_url('contact_Controller/send'); ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <select name="email" id="email" class="form-control" required>
                    <option value="">Choisir un email</option>
                    <?php foreach ($candidatsValides as $candidat): ?>
                        <option value="<?= htmlspecialchars($candidat->email) ?>">
                            <?= htmlspecialchars($candidat->email) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            let form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                alert("Veuillez remplir tous les champs.");
            }
        });
    </script>
</body>
</html>
