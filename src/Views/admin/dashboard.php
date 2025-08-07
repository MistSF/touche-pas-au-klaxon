<?php // src/Views/admin/dashboard.php ?>

<h1><?= htmlspecialchars($title) ?></h1>
<p class="lead">Bienvenue dans l'espace d'administration. D'ici, vous pouvez gérer les utilisateurs, les agences et les trajets de l'application.</p>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Gérer les Utilisateurs</h5>
                <p class="card-text">Consulter la liste de tous les employés inscrits.</p>
                <a href="index.php?action=adminListUsers" class="btn btn-primary">Voir les utilisateurs</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Gérer les Agences</h5>
                <p class="card-text">Ajouter, modifier ou supprimer des agences (villes).</p>
                <a href="index.php?action=adminListAgencies" class="btn btn-primary">Voir les agences</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Gérer les Trajets</h5>
                <p class="card-text">Consulter et supprimer n'importe quel trajet.</p>
                <a href="index.php?action=adminListTrips" class="btn btn-primary">Voir les trajets</a>
            </div>
        </div>
    </div>
</div>
