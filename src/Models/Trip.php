<?php
// src/Models/Trip.php
namespace Models;

use PDO;
use Utils\Database;

class Trip {
    
    // ... (les méthodes existantes findAllAvailable, findById, create, update, delete restent ici) ...

    /**
     * Récupère tous les trajets futurs et disponibles avec les détails de l'auteur.
     */
    public function findAllAvailable(): array {
        $pdo = Database::getInstance();
        $sql = "
            SELECT 
                t.id, t.date_heure_depart, t.date_heure_arrivee, t.places_total, t.places_disponibles,
                t.id_utilisateur_auteur,
                ville_depart.ville AS agence_depart,
                ville_arrivee.ville AS agence_arrivee,
                auteur.nom AS auteur_nom,
                auteur.prenom AS auteur_prenom,
                auteur.telephone AS auteur_telephone,
                auteur.email AS auteur_email
            FROM trajets AS t
            JOIN agences AS ville_depart ON t.id_agence_depart = ville_depart.id
            JOIN agences AS ville_arrivee ON t.id_agence_arrivee = ville_arrivee.id
            JOIN utilisateurs AS auteur ON t.id_utilisateur_auteur = auteur.id
            WHERE t.places_disponibles > 0 AND t.date_heure_depart > NOW()
            ORDER BY t.date_heure_depart ASC
        ";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Trouve un trajet unique par son ID.
     */
    public function findById(int $id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM trajets WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Crée un nouveau trajet dans la base de données.
     */
    public function create(array $data): bool {
        $pdo = Database::getInstance();
        $sql = "INSERT INTO trajets (date_heure_depart, date_heure_arrivee, places_total, places_disponibles, id_utilisateur_auteur, id_agence_depart, id_agence_arrivee) 
                VALUES (:date_heure_depart, :date_heure_arrivee, :places_total, :places_disponibles, :id_utilisateur_auteur, :id_agence_depart, :id_agence_arrivee)";
        
        $stmt = $pdo->prepare($sql);
        
        return $stmt->execute([
            'date_heure_depart' => $data['date_heure_depart'],
            'date_heure_arrivee' => $data['date_heure_arrivee'],
            'places_total' => $data['places_total'],
            'places_disponibles' => $data['places_total'],
            'id_utilisateur_auteur' => $data['id_utilisateur_auteur'],
            'id_agence_depart' => $data['id_agence_depart'],
            'id_agence_arrivee' => $data['id_agence_arrivee']
        ]);
    }

    /**
     * Met à jour un trajet existant.
     */
    public function update(int $id, array $data): bool {
        $pdo = Database::getInstance();
        $sql = "UPDATE trajets SET 
                    date_heure_depart = :date_heure_depart,
                    date_heure_arrivee = :date_heure_arrivee,
                    places_total = :places_total,
                    places_disponibles = :places_disponibles,
                    id_agence_depart = :id_agence_depart,
                    id_agence_arrivee = :id_agence_arrivee
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        return $stmt->execute([
            'id' => $id,
            'date_heure_depart' => $data['date_heure_depart'],
            'date_heure_arrivee' => $data['date_heure_arrivee'],
            'places_total' => $data['places_total'],
            'places_disponibles' => $data['places_disponibles'],
            'id_agence_depart' => $data['id_agence_depart'],
            'id_agence_arrivee' => $data['id_agence_arrivee']
        ]);
    }

    /**
     * Supprime un trajet.
     */
    public function delete(int $id): bool {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM trajets WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Récupère TOUS les trajets pour le tableau de bord de l'administrateur.
     *
     * @return array La liste de tous les trajets.
     */
    public function findAllForAdmin(): array {
        $pdo = Database::getInstance();
        $sql = "
            SELECT 
                t.id, t.date_heure_depart, t.places_disponibles,
                ville_depart.ville AS agence_depart,
                ville_arrivee.ville AS agence_arrivee,
                CONCAT(auteur.prenom, ' ', auteur.nom) AS auteur_nom_complet
            FROM trajets AS t
            JOIN agences AS ville_depart ON t.id_agence_depart = ville_depart.id
            JOIN agences AS ville_arrivee ON t.id_agence_arrivee = ville_arrivee.id
            JOIN utilisateurs AS auteur ON t.id_utilisateur_auteur = auteur.id
            ORDER BY t.date_heure_depart DESC
        ";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
