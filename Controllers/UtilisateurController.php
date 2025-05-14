<?php
require_once __DIR__ . '/../Models/Utilisateur.php';
require_once __DIR__ . '/../Models/Admin.php';
require_once __DIR__ . '/../Config/config.php'; // Inclusion correcte pour la connexion à la base de données

class UtilisateurController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $utilisateur = new Utilisateur();

            // Charger le modèle Admin pour vérifier les administrateurs
            $adminModel = new Admin(Database::getConnection());
            $admin = $adminModel->getAdminByEmail($email);
            if ($admin && password_verify($password, $admin['password'])) {
                // Démarrer une session pour l'administrateur
                session_start();
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_name'] = $admin['nom'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['role'] = 'admin';

                // Rediriger vers le tableau de bord des administrateurs
                header('Location: ../Views/Admin/admin_dashboard.php');
                exit();
            }

            // Vérifier ensuite dans la table des utilisateurs
            $user = $utilisateur->getUtilisateurByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                // Démarrer une session pour l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = 'user';

                // Rediriger vers la page d'accueil des utilisateurs
                header('Location: ../Views/Utilisateur/accueil.php');
                exit();
            } else {
                // Message d'erreur en cas d'identifiants incorrects
                echo "<script>alert('Identifiant ou mot de passe incorrect.'); window.location.href='../Views/Utilisateur/connexion.php';</script>";
            }
        }
    }
}
