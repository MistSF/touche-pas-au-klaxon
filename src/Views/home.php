<?php ?>

<h1><?= htmlspecialchars($title) ?></h1>
<p class="lead">Voici la liste des trajets prévus. Connectez-vous pour obtenir plus de détails ou pour proposer un nouveau trajet.</p>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Départ</th>
                <th>Date de départ</th>
                <th>Arrivée</th>
                <th>Places restantes</th>
                <?php if (isset($_SESSION['user'])): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($trips)): ?>
                <tr>
                    <td colspan="<?= isset($_SESSION['user']) ? '5' : '4' ?>" class="text-center">Aucun trajet disponible pour le moment.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($trips as $trip): ?>
                    <tr>
                        <td><?= htmlspecialchars($trip['agence_depart']) ?></td>
                        <td><?= (new DateTime($trip['date_heure_depart']))->format('d/m/Y à H:i') ?></td>
                        <td><?= htmlspecialchars($trip['agence_arrivee']) ?></td>
                        <td><span class="badge bg-success"><?= htmlspecialchars($trip['places_disponibles']) ?></span></td>
                        
                        <?php if (isset($_SESSION['user'])): ?>
                            <td>
                                <!-- Bouton pour la modale de détails -->
                                <button type="button" class="btn btn-sm btn-info details-btn" 
                                        data-bs-toggle="modal" data-bs-target="#tripDetailsModal"
                                        data-author-name="<?= htmlspecialchars($trip['auteur_prenom'] . ' ' . $trip['auteur_nom']) ?>"
                                        data-author-phone="<?= htmlspecialchars($trip['auteur_telephone']) ?>"
                                        data-author-email="<?= htmlspecialchars($trip['auteur_email']) ?>"
                                        data-total-seats="<?= htmlspecialchars($trip['places_total']) ?>">
                                    Détails
                                </button>

                                <!-- Boutons Modifier/Supprimer si l'utilisateur est l'auteur -->
                                <?php if ($_SESSION['user']['id'] === $trip['id_utilisateur_auteur']): ?>
                                    <a href="index.php?action=editTrip&id=<?= $trip['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="index.php?action=deleteTrip&id=<?= $trip['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">Supprimer</a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Fenêtre Modale pour les détails du trajet -->
<div class="modal fade" id="tripDetailsModal" tabindex="-1" aria-labelledby="tripDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tripDetailsModalLabel">Détails du Trajet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Personne à contacter</h5>
        <p><strong>Nom :</strong> <span id="modalAuthorName"></span></p>
        <p><strong>Téléphone :</strong> <span id="modalAuthorPhone"></span></p>
        <p><strong>Email :</strong> <span id="modalAuthorEmail"></span></p>
        <hr>
        <h5>Informations complémentaires</h5>
        <p><strong>Nombre total de places :</strong> <span id="modalTotalSeats"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
