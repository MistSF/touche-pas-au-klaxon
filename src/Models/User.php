<?php
// src/Models/User.php
namespace Models;

use PDO;
use Utils\Database;

class User {
    /**
     * Trouve un utilisateur par son adresse email.
     *
     * @param string $email L'email de l'utilisateur à trouver.
     * @return array|false Les données de l'utilisateur ou false s'il n'est pas trouvé.
     */
    public function findByEmail(string $email) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Récupère tous les utilisateurs, triés par nom de famille.
     *
     * @return array La liste de tous les utilisateurs.
     */
    public function findAll(): array {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT id, nom, prenom, email, telephone, role FROM utilisateurs ORDER BY nom ASC");
        return $stmt->fetchAll();
    }
}
