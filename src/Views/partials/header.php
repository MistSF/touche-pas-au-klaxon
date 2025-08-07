<?php // src/Views/partials/header.php ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php?action=<?= (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') ? 'adminDashboard' : 'home' ?>">Touche pas au Klaxon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <?php if (isset($_SESSION['user'])): ?>
            
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <!-- Menu pour Administrateur -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=adminListUsers">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=adminListAgencies">Agences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=adminListTrips">Trajets</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger ms-3" href="index.php?action=logout">Déconnexion</a>
                </li>
            <?php else: ?>
                <!-- Menu pour Utilisateur standard -->
                <li class="nav-item">
                    <a class="btn btn-success me-2" href="index.php?action=createTrip">Proposer un trajet</a>
                </li>
                <li class="nav-item">
                    <span class="navbar-text me-3">
                        Bonjour, <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="index.php?action=logout">Déconnexion</a>
                </li>
            <?php endif; ?>

        <?php else: ?>
            <!-- Menu pour Visiteur -->
            <li class="nav-item">
                <a class="btn btn-primary" href="index.php?action=login">Connexion</a>
            </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
