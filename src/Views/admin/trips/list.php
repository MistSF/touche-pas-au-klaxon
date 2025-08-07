<?php ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?action=adminDashboard">Tableau de bord</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion des Trajets</li>
  </ol>
</nav>

<h1>Gestion des Trajets</h1>
<p>Voici la liste de tous les trajets, y compris ceux qui sont passés ou complets.</p>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date de départ</th>
                <th>Auteur</th>
                <th>Places restantes</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trips as $trip): ?>
            <tr>
                <td><?= $trip['id'] ?></td>
                <td><?= htmlspecialchars($trip['agence_depart']) ?></td>
                <td><?= htmlspecialchars($trip['agence_arrivee']) ?></td>
                <td><?= (new DateTime($trip['date_heure_depart']))->format('d/m/Y H:i') ?></td>
                <td><?= htmlspecialchars($trip['auteur_nom_complet']) ?></td>
                <td>
                    <?php 
                        $badgeClass = 'bg-success';
                        if ($trip['places_disponibles'] == 0) {
                            $badgeClass = 'bg-warning text-dark';
                        }
                        if (new DateTime($trip['date_heure_depart']) < new DateTime()) {
                            $badgeClass = 'bg-secondary';
                        }
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= $trip['places_disponibles'] ?></span>
                </td>
                <td class="text-end">
                    <a href="index.php?action=adminDeleteTrip&id=<?= $trip['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ? Cette action est irréversible.');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
