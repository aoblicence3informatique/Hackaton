<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté et son rôle
        session_start();
        if (isset($_SESSION['user_id'])) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                // Rediriger vers le tableau de bord des administrateurs
                header('Location: ../Views/Admin/admin_dashboard.php');
            } else {
                // Rediriger vers la page d'accueil des utilisateurs
                header('Location: ../Views/Utilisateur/accueil.php');
            }
        } else {
            // Rediriger vers la page de connexion si non connecté
            header('Location: ../Views/Utilisateur/connexion.php');
        }
        exit();
    }
}
