<?php
// public/index.php

// ===== CHARGEMENT DE L'AUTOLOADER COMPOSER =====
// Cette ligne est essentielle. Elle charge toutes les bibliothèques installées via Composer.
require __DIR__ . '/../vendor/autoload.php';

// Démarrer la session pour pouvoir utiliser $_SESSION
session_start();

// ====== AUTOLOADER POUR VOS CLASSES PERSONNELLES ======
// Charge automatiquement les classes de votre dossier /src
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $file = __DIR__ . '/../src/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});


// ====== ROUTEUR ======
$action = $_GET['action'] ?? 'home';

try {
    switch ($action) {
        // --- Pages publiques ---
        case 'home':
            $controller = new Controllers\TripController();
            $controller->listPublicTrips();
            break;

        // --- Authentification ---
        case 'login':
            $controller = new Controllers\AuthController();
            $controller->showLoginPage();
            break;
        case 'handleLogin':
            $controller = new Controllers\AuthController();
            $controller->handleLogin();
            break;
        case 'logout':
            $controller = new Controllers\AuthController();
            $controller->logout();
            break;

        // --- Trajets (Utilisateur connecté) ---
        case 'createTrip':
            $controller = new Controllers\TripController();
            $controller->showCreateForm();
            break;
        case 'storeTrip':
            $controller = new Controllers\TripController();
            $controller->storeNewTrip();
            break;
        case 'editTrip':
            if (isset($_GET['id'])) {
                $controller = new Controllers\TripController();
                $controller->showEditForm($_GET['id']);
            } else {
                throw new Exception("ID du trajet manquant.");
            }
            break;
        case 'updateTrip':
             if (isset($_GET['id'])) {
                $controller = new Controllers\TripController();
                $controller->updateTrip($_GET['id']);
            } else {
                throw new Exception("ID du trajet manquant.");
            }
            break;
        case 'deleteTrip':
            if (isset($_GET['id'])) {
                $controller = new Controllers\TripController();
                $controller->deleteTrip($_GET['id']);
            } else {
                throw new Exception("ID du trajet manquant.");
            }
            break;
            
        // --- Tableau de bord Administrateur ---
        case 'adminDashboard':
            $controller = new Controllers\AdminController();
            $controller->dashboard();
            break;
        case 'adminListUsers':
            $controller = new Controllers\AdminController();
            $controller->listUsers();
            break;
        case 'adminListAgencies':
            $controller = new Controllers\AdminController();
            $controller->listAgencies();
            break;
        case 'adminCreateAgency':
            $controller = new Controllers\AdminController();
            $controller->showCreateAgencyForm();
            break;
        case 'adminStoreAgency':
            $controller = new Controllers\AdminController();
            $controller->storeAgency();
            break;
        case 'adminEditAgency':
            if (isset($_GET['id'])) {
                $controller = new Controllers\AdminController();
                $controller->showEditAgencyForm($_GET['id']);
            } else {
                die("ID de l'agence manquant.");
            }
            break;
        case 'adminUpdateAgency':
            if (isset($_GET['id'])) {
                $controller = new Controllers\AdminController();
                $controller->updateAgency($_GET['id']);
            } else {
                die("ID de l'agence manquant.");
            }
            break;
        case 'adminDeleteAgency':
            if (isset($_GET['id'])) {
                $controller = new Controllers\AdminController();
                $controller->deleteAgency($_GET['id']);
            } else {
                die("ID de l'agence manquant.");
            }
            break;
        case 'adminListTrips':
            $controller = new Controllers\AdminController();
            $controller->listTrips();
            break;
        case 'adminDeleteTrip':
            if (isset($_GET['id'])) {
                $controller = new Controllers\AdminController();
                $controller->adminDeleteTrip($_GET['id']);
            } else {
                die("ID du trajet manquant.");
            }
            break;

        default:
            throw new Exception("Page non trouvée");
            break;
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
    require __DIR__ . '/../src/Views/error.php';
}
