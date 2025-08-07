<?php ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?action=adminDashboard">Tableau de bord</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion des Agences</li>
  </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Gestion des Agences</h1>
    <a href="index.php?action=adminCreateAgency" class="btn btn-success">Créer une nouvelle agence</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ville</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($agencies as $agency): ?>
        <tr>
            <td><?= $agency['id'] ?></td>
            <td><?= htmlspecialchars($agency['ville']) ?></td>
            <td class="text-end">
                <a href="index.php?action=adminEditAgency&id=<?= $agency['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                <a href="index.php?action=adminDeleteAgency&id=<?= $agency['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ? Les trajets associés pourraient être affectés.');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
