<?php
// src/Controllers/TripController.php

namespace Controllers;

use Models\Trip;
use Models\Agency;

class TripController {
    
    /**
     * Affiche la page d'accueil avec la liste des trajets disponibles.
     */
    public function listPublicTrips() {
        $tripModel = new Trip();
        $trips = $tripModel->findAllAvailable();
        $title = "Prochains trajets disponibles";
        
        ob_start();
        require __DIR__ . '/../Views/home.php';
        $content = ob_get_clean();
        
        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * Affiche le formulaire de création de trajet.
     */
    public function showCreateForm() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $agencyModel = new Agency();
        $agencies = $agencyModel->findAll();

        $title = "Proposer un nouveau trajet";
        ob_start();
        require __DIR__ . '/../Views/trip/form.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * Traite la soumission du formulaire de création de trajet.
     */
    public function storeNewTrip() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

        if ($_POST['id_agence_depart'] === $_POST['id_agence_arrivee']) {
            die("Erreur : L'agence de départ et d'arrivée doivent être différentes.");
        }
        if ($_POST['date_heure_depart'] >= $_POST['date_heure_arrivee']) {
            die("Erreur : La date de départ doit être antérieure à la date d'arrivée.");
        }

        $tripModel = new Trip();
        $tripModel->create([
            'date_heure_depart' => $_POST['date_heure_depart'],
            'date_heure_arrivee' => $_POST['date_heure_arrivee'],
            'places_total' => (int)$_POST['places_total'],
            'id_utilisateur_auteur' => $_SESSION['user']['id'],
            'id_agence_depart' => (int)$_POST['id_agence_depart'],
            'id_agence_arrivee' => (int)$_POST['id_agence_arrivee']
        ]);

        header('Location: index.php?action=home');
        exit();
    }

    /**
     * Affiche le formulaire pour modifier un trajet.
     */
    public function showEditForm(int $id) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $tripModel = new Trip();
        $trip = $tripModel->findById($id);

        // Sécurité : on vérifie que le trajet existe et que l'utilisateur est bien l'auteur
        if (!$trip || $trip['id_utilisateur_auteur'] !== $_SESSION['user']['id']) {
            http_response_code(403); // Forbidden
            die("Accès non autorisé.");
        }

        $agencyModel = new Agency();
        $agencies = $agencyModel->findAll();

        $title = "Modifier le trajet";
        ob_start();
        require __DIR__ . '/../Views/trip/form.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * Traite la soumission du formulaire de modification.
     */
    public function updateTrip(int $id) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $tripModel = new Trip();
        $trip = $tripModel->findById($id);

        // Sécurité : on vérifie que le trajet existe et que l'utilisateur est bien l'auteur
        if (!$trip || $trip['id_utilisateur_auteur'] !== $_SESSION['user']['id']) {
            http_response_code(403);
            die("Accès non autorisé.");
        }

        // Contrôles de cohérence
        if ($_POST['id_agence_depart'] === $_POST['id_agence_arrivee']) {
            die("Erreur : L'agence de départ et d'arrivée doivent être différentes.");
        }
        if ($_POST['date_heure_depart'] >= $_POST['date_heure_arrivee']) {
            die("Erreur : La date de départ doit être antérieure à la date d'arrivée.");
        }
        
        // Calcul des places disponibles
        $placesTotal = (int)$_POST['places_total'];
        $placesPrises = $trip['places_total'] - $trip['places_disponibles'];
        $placesDisponibles = $placesTotal - $placesPrises;
        
        if ($placesDisponibles < 0) {
            die("Erreur : Le nombre de places totales ne peut être inférieur au nombre de places déjà réservées.");
        }

        $tripModel->update($id, [
            'date_heure_depart' => $_POST['date_heure_depart'],
            'date_heure_arrivee' => $_POST['date_heure_arrivee'],
            'places_total' => $placesTotal,
            'places_disponibles' => $placesDisponibles,
            'id_agence_depart' => (int)$_POST['id_agence_depart'],
            'id_agence_arrivee' => (int)$_POST['id_agence_arrivee']
        ]);

        header('Location: index.php?action=home');
        exit();
    }

    /**
     * Supprime un trajet.
     */
    public function deleteTrip(int $id) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $tripModel = new Trip();
        $trip = $tripModel->findById($id);

        // Sécurité : on vérifie que le trajet existe et que l'utilisateur est bien l'auteur
        if (!$trip || $trip['id_utilisateur_auteur'] !== $_SESSION['user']['id']) {
            http_response_code(403);
            die("Accès non autorisé.");
        }

        $tripModel->delete($id);

        header('Location: index.php?action=home');
        exit();
    }
}
