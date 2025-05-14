<?php

namespace Controllers;

require_once '../Models/Admin.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        $db = new Database();
        $this->adminModel = new Admin($db->getConnection());
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $admin = $this->adminModel->findByEmail($email);

            if ($admin && password_verify($password, $admin['mot_de_passe'])) {
                session_start();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['nom'];
                $_SESSION['role'] = 'admin';

                // Rediriger vers le tableau de bord des administrateurs
                header('Location: ../Views/Admin/admin_dashboard.php');
                exit();
            } else {
                // Message d'erreur en cas d'identifiants incorrects
                echo "<script>alert('Identifiant ou mot de passe incorrect.'); window.location.href='../Views/Admin/admin_login.php';</script>";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function index() {
        // Rediriger vers la page d'accueil des administrateurs
        header('Location: ../Views/Admin/admin_dashboard.php');
        exit();
    }
}
