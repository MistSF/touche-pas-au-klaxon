<?php // src/Views/trip/form.php ?>

<h1><?= htmlspecialchars($title) ?></h1>

<div class="card">
    <div class="card-body">
        <!-- L'action du formulaire est dynamique : soit 'storeTrip' (création) soit 'updateTrip' (modification) -->
        <form action="index.php?action=<?= isset($trip) ? 'updateTrip&id=' . $trip['id'] : 'storeTrip' ?>" method="POST">
            
            <fieldset class="mb-3">
                <legend>Personne à contacter</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>" disabled>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Informations sur le trajet</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_agence_depart" class="form-label">Agence de départ</label>
                        <select class="form-select" id="id_agence_depart" name="id_agence_depart" required>
                            <option value="">-- Choisir une agence --</option>
                            <?php foreach ($agencies as $agency): ?>
                                <!-- Si on est en mode édition, on sélectionne la bonne agence -->
                                <option value="<?= $agency['id'] ?>" <?= (isset($trip) && $trip['id_agence_depart'] == $agency['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agency['ville']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_agence_arrivee" class="form-label">Agence d'arrivée</label>
                        <select class="form-select" id="id_agence_arrivee" name="id_agence_arrivee" required>
                            <option value="">-- Choisir une agence --</option>
                            <?php foreach ($agencies as $agency): ?>
                                <option value="<?= $agency['id'] ?>" <?= (isset($trip) && $trip['id_agence_arrivee'] == $agency['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agency['ville']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_heure_depart" class="form-label">Date et heure de départ</label>
                        <!-- On formate la date pour qu'elle soit compatible avec l'input datetime-local -->
                        <input type="datetime-local" class="form-control" id="date_heure_depart" name="date_heure_depart" 
                               value="<?= isset($trip) ? (new DateTime($trip['date_heure_depart']))->format('Y-m-d\TH:i') : '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_heure_arrivee" class="form-label">Date et heure d'arrivée</label>
                        <input type="datetime-local" class="form-control" id="date_heure_arrivee" name="date_heure_arrivee"
                               value="<?= isset($trip) ? (new DateTime($trip['date_heure_arrivee']))->format('Y-m-d\TH:i') : '' ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="places_total" class="form-label">Nombre total de places (sans le conducteur)</label>
                        <input type="number" class="form-control" id="places_total" name="places_total" min="1" 
                               value="<?= isset($trip) ? htmlspecialchars($trip['places_total']) : '' ?>" required>
                    </div>
                </div>
            </fieldset>
            
            <!-- Le texte du bouton change en fonction du contexte -->
            <button type="submit" class="btn btn-primary"><?= isset($trip) ? 'Modifier le trajet' : 'Créer le trajet' ?></button>
            <a href="index.php?action=home" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
