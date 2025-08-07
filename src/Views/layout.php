<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Touche pas au Klaxon' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php require 'partials/header.php'; ?>
    </header>

    <main class="container mt-4">
        <?= $content ?>
    </main>

    <footer class="container mt-5">
        <?php require 'partials/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script pour la fenêtre modale -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tripDetailsModal = document.getElementById('tripDetailsModal');
            if (tripDetailsModal) {
                tripDetailsModal.addEventListener('show.bs.modal', function (event) {
                    // Bouton qui a déclenché la modale
                    const button = event.relatedTarget;

                    // Extraction des informations des attributs data-*
                    const authorName = button.getAttribute('data-author-name');
                    const authorPhone = button.getAttribute('data-author-phone');
                    const authorEmail = button.getAttribute('data-author-email');
                    const totalSeats = button.getAttribute('data-total-seats');

                    // Mise à jour du contenu de la modale
                    tripDetailsModal.querySelector('#modalAuthorName').textContent = authorName;
                    tripDetailsModal.querySelector('#modalAuthorPhone').textContent = authorPhone;
                    tripDetailsModal.querySelector('#modalAuthorEmail').textContent = authorEmail;
                    tripDetailsModal.querySelector('#modalTotalSeats').textContent = totalSeats;
                });
            }
        });
    </script>
</body>
</html>
