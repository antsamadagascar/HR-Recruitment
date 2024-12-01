<div class="container mt-4">
    <h1 class="text-center">Envoyer une Notification</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('Notifications_Controller/sendNotification') ?>" method="POST">
        <div class="form-group">
            <label for="idcandidat">Sélectionner un Candidat</label>
            <select name="idcandidat" id="idcandidat" class="form-control">
                <option value="">Choisir un candidat</option>
                <?php foreach ($candidatsValides as $candidat): ?>
                    <option value="<?= htmlspecialchars($candidat->idcandidat) ?>"><?= htmlspecialchars($candidat->nom . ' ' . $candidat->prenom) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>

      
    <button type="submit" class="btn btn-primary" onclick="showAlert()">Envoyer Notification</button>
    </form>
    <script>
        function showAlert() {
            var idCandidat = document.getElementById('idcandidat').value;
            var message = document.getElementById('message').value;

            var alertMessage = "Données envoyées :\n\n";
            alertMessage += "Candidat ID: " + idCandidat + "\n";
            alertMessage += "Message: " + message + "\n";

            alert(alertMessage);
        return false;
    }

        </script>
</div>
