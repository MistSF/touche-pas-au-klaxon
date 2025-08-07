<?php
// src/Models/Agency.php
namespace Models;

use PDO;
use Utils\Database;

class Agency {
    /**
     * Récupère toutes les agences, triées par ordre alphabétique.
     *
     * @return array La liste des agences.
     */
    public function findAll(): array {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM agences ORDER BY ville ASC");
        return $stmt->fetchAll();
    }

    /**
     * Trouve une agence par son ID.
     *
     * @param int $id L'ID de l'agence à trouver.
     * @return array|false Les données de l'agence ou false si non trouvée.
     */
    public function findById(int $id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM agences WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Crée une nouvelle agence.
     *
     * @param string $ville Le nom de la ville de la nouvelle agence.
     * @return bool True si la création a réussi, false sinon.
     */
    public function create(string $ville): bool {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO agences (ville) VALUES (:ville)");
        return $stmt->execute(['ville' => $ville]);
    }

    /**
     * Met à jour le nom d'une agence.
     *
     * @param int $id L'ID de l'agence à mettre à jour.
     * @param string $ville Le nouveau nom de la ville.
     * @return bool True si la mise à jour a réussi, false sinon.
     */
    public function update(int $id, string $ville): bool {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE agences SET ville = :ville WHERE id = :id");
        return $stmt->execute(['id' => $id, 'ville' => $ville]);
    }

    /**
     * Supprime une agence.
     *
     * @param int $id L'ID de l'agence à supprimer.
     * @return bool True si la suppression a réussi, false sinon.
     */
    public function delete(int $id): bool {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM agences WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
