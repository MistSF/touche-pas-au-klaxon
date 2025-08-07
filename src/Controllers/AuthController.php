<?php
namespace Controllers;

use Models\User;

class AuthController {

    /**
     * Affiche la page de connexion.
     */
    public function showLoginPage() {
        $title = "Connexion";
        ob_start();
        // On récupère un éventuel message d'erreur depuis l'URL
        $errorMessage = $_GET['error'] ?? null;
        require __DIR__ . '/../Views/login.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * Traite la soumission du formulaire de connexion.
     */
    public function handleLogin() {
        // On vérifie que les données du formulaire sont présentes
        if (empty($_POST['email']) || empty($_POST['password'])) {
            header('Location: index.php?action=login&error=Veuillez remplir tous les champs.');
            exit();
        }

        $userModel = new User();
        $user = $userModel->findByEmail($_POST['email']);

        // Si l'utilisateur existe ET que le mot de passe est correct
        if ($user && password_verify($_POST['password'], $user['mot_de_passe'])) {
            // On stocke les informations de l'utilisateur en session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            // On redirige vers la page d'accueil
            header('Location: index.php?action=home');
            exit();
        } else {
            // Sinon, on redirige vers la page de connexion avec un message d'erreur
            header('Location: index.php?action=login&error=Email ou mot de passe incorrect.');
            exit();
        }
    }

    /**
     * Gère la déconnexion de l'utilisateur.
     */
    public function logout() {
        // On détruit la session
        session_destroy();
        // On redirige vers la page d'accueil
        header('Location: index.php?action=home');
        exit();
    }
}
