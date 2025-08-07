<?php
// src/Utils/Database.php
namespace Utils;

use PDO;
use PDOException;
use Dotenv\Dotenv; // Import de la classe Dotenv

class Database {
    private static $instance = null;

    /**
     * Retourne une connexion à la base de données (Singleton).
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            // Chargement des variables d'environnement
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // Le chemin vers la racine du projet
            $dotenv->load();

            // Utilisation des variables d'environnement
            $host = $_ENV['DB_HOST'];
            $db   = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$instance;
    }
}
