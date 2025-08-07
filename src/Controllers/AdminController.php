<?php
// src/Controllers/AdminController.php
namespace Controllers;

use Models\Agency;
use Models\User;
use Models\Trip;

class AdminController {

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            die("Accès interdit. Vous devez être administrateur pour accéder à cette page.");
        }
    }

    public function dashboard() {
        $title = "Tableau de bord Administrateur";
        ob_start();
        require __DIR__ . '/../Views/admin/dashboard.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // --- Gestion des Agences ---
    public function listAgencies() {
        $agencyModel = new Agency();
        $agencies = $agencyModel->findAll();
        $title = "Gestion des Agences";
        ob_start();
        require __DIR__ . '/../Views/admin/agencies/list.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function showCreateAgencyForm() {
        $title = "Créer une nouvelle agence";
        ob_start();
        require __DIR__ . '/../Views/admin/agencies/form.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function storeAgency() {
        if (isset($_POST['ville']) && !empty(trim($_POST['ville']))) {
            $agencyModel = new Agency();
            $agencyModel->create(trim($_POST['ville']));
        }
        header('Location: index.php?action=adminListAgencies');
        exit();
    }

    public function showEditAgencyForm(int $id) {
        $agencyModel = new Agency();
        $agency = $agencyModel->findById($id);
        if (!$agency) {
            http_response_code(404);
            die("Agence non trouvée.");
        }
        $title = "Modifier l'agence : " . htmlspecialchars($agency['ville']);
        ob_start();
        require __DIR__ . '/../Views/admin/agencies/form.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function updateAgency(int $id) {
        if (isset($_POST['ville']) && !empty(trim($_POST['ville']))) {
            $agencyModel = new Agency();
            $agencyModel->update($id, trim($_POST['ville']));
        }
        header('Location: index.php?action=adminListAgencies');
        exit();
    }

    public function deleteAgency(int $id) {
        $agencyModel = new Agency();
        $agencyModel->delete($id);
        header('Location: index.php?action=adminListAgencies');
        exit();
    }

    // --- Gestion des Utilisateurs ---
    public function listUsers() {
        $userModel = new User();
        $users = $userModel->findAll();
        $title = "Gestion des Utilisateurs";
        ob_start();
        require __DIR__ . '/../Views/admin/users/list.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    // --- Gestion des Trajets ---
    public function listTrips() {
        $tripModel = new Trip();
        $trips = $tripModel->findAllForAdmin();
        $title = "Gestion des Trajets";
        ob_start();
        require __DIR__ . '/../Views/admin/trips/list.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    public function adminDeleteTrip(int $id) {
        $tripModel = new Trip();
        // La méthode delete du modèle Trip est réutilisée ici
        $tripModel->delete($id);
        header('Location: index.php?action=adminListTrips');
        exit();
    }
}
