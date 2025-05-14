<?php
class Signalement
{
    private $db;

    public function __construct()
    {
        include_once __DIR__ . '/../Config/config.php';
        $this->db = Database::getConnection(); // Utilise la classe Database pour obtenir la connexion PDO
    }

    public function ajouterSignalement($data)
    {
        $stmt = $this->db->prepare("INSERT INTO signalements (utilisateur_id, titre, description, photo_url, latitude, longitude, type_probleme, statut) VALUES (?, ?, ?, ?, ?, ?, ?, 'Nouveau')");
        return $stmt->execute([
            $data['utilisateur_id'],
            $data['titre'],
            $data['description'],
            $data['photo_url'],
            $data['latitude'],
            $data['longitude'],
            $data['type_probleme']
        ]);
    }

    public function getSignalementById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM signalements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTousLesSignalements()
    {
        $stmt = $this->db->query("SELECT * FROM signalements");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validerSignalement($id)
    {
        $stmt = $this->db->prepare("UPDATE signalements SET statut = 'Résolu' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function rejeterSignalement($id)
    {
        $stmt = $this->db->prepare("UPDATE signalements SET statut = 'Rejeté' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function traiterSignalement($id)
    {
        $stmt = $this->db->prepare("UPDATE signalements SET statut = 'En cours de traitement' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function filtrerSignalements($criteria)
    {
        $stmt = $this->db->prepare("SELECT * FROM signalements WHERE type_probleme = ?");
        $stmt->execute([$criteria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function classerSignalements($order)
    {
        $stmt = $this->db->query("SELECT * FROM signalements ORDER BY $order");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
