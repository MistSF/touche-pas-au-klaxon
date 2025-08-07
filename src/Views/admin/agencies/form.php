<?php ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?action=adminDashboard">Tableau de bord</a></li>
    <li class="breadcrumb-item"><a href="index.php?action=adminListAgencies">Gestion des Agences</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
  </ol>
</nav>

<div class="card">
    <div class="card-header">
        <h1><?= $title ?></h1>
    </div>
    <div class="card-body">
        <!-- L'action du formulaire est dynamique -->
        <form action="index.php?action=<?= isset($agency) ? 'adminUpdateAgency&id=' . $agency['id'] : 'adminStoreAgency' ?>" method="POST">
            <div class="mb-3">
                <label for="ville" class="form-label">Nom de la ville</label>
                <!-- La valeur est pré-remplie si on est en mode édition -->
                <input type="text" class="form-control" id="ville" name="ville" value="<?= isset($agency) ? htmlspecialchars($agency['ville']) : '' ?>" required>
            </div>
            
            <!-- Le texte du bouton change en fonction du contexte -->
            <button type="submit" class="btn btn-primary"><?= isset($agency) ? 'Modifier' : 'Enregistrer' ?></button>
            <a href="index.php?action=adminListAgencies" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
