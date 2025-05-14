<?php
class Report {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM reports ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO reports 
            (description, category, photo, latitude, longitude) 
            VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['description'],
            $data['category'],
            $data['photo'],
            $data['latitude'],
            $data['longitude']
        ]);
    }

    public function vote($report_id, $user_ip) {
        $check = $this->pdo->prepare("SELECT * FROM votes WHERE report_id = ? AND user_ip = ?");
        $check->execute([$report_id, $user_ip]);
        if ($check->rowCount() == 0) {
            $stmt = $this->pdo->prepare("INSERT INTO votes (report_id, user_ip) VALUES (?, ?)");
            return $stmt->execute([$report_id, $user_ip]);
        }
        return false; // déjà voté
    }

    public function getVoteCount($report_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM votes WHERE report_id = ?");
        $stmt->execute([$report_id]);
        return $stmt->fetch()['total'];
    }
}
