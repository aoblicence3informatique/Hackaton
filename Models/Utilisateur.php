<?php
require_once __DIR__ . '/../Config/config.php';

class Utilisateur
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getUtilisateurByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function enregistrerUtilisateur($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hashedPassword]);
    }

    public function enregistrerUtilisateurComplet($nom, $email, $mot_de_passe, $telephone, $role_id)
    {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, téléphone, role_id, est_confirmé) VALUES (?, ?, ?, ?, ?, 0)");
        return $stmt->execute([$nom, $email, $hashedPassword, $telephone, $role_id]);
    }

    public function verifierUtilisateur($email)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
