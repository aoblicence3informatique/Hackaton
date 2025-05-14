<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Models/Signalement.php';

class SignalementController
{
    // Ajouter un nouveau signalement
    public function ajouter($data)
    {
        $signalement = new Signalement();
        return $signalement->ajouterSignalement($data);
    }

    // Obtenir un signalement spécifique par ID
    public function afficher($id)
    {
        $signalement = new Signalement();
        return $signalement->getSignalementById($id);
    }

    // Lister tous les signalements
    public function lister()
    {
        $signalement = new Signalement();
        return $signalement->getTousLesSignalements();
    }

    // Valider un signalement
    public function valider($id)
    {
        $signalement = new Signalement();
        return $signalement->validerSignalement($id);
    }

    // Rejeter un signalement
    public function rejeter($id)
    {
        $signalement = new Signalement();
        return $signalement->rejeterSignalement($id);
    }

    // Traiter un signalement
    public function traiter($id)
    {
        $signalement = new Signalement();
        return $signalement->traiterSignalement($id);
    }

    // Filtrer les signalements
    public function filtrer($criteria)
    {
        $signalement = new Signalement();
        return $signalement->filtrerSignalements($criteria);
    }

    // Classer les signalements
    public function classer($order)
    {
        $signalement = new Signalement();
        return $signalement->classerSignalements($order);
    }

    // Afficher tous les signalements
    public function afficherTous()
    {
        $signalement = new Signalement();
        $signalements = $signalement->getTousLesSignalements();

        // Inclure la vue pour afficher les signalements
        include __DIR__ . '/../Views/Admin/admin_signalements.php';
    }

    // Méthode pour gérer le stockage des signalements
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $description = $_POST['description'];
            $category = $_POST['category'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            // Gérer l'upload de la photo
            $photo = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $photo = $uploadDir . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
            }

            // Préparer les données pour le modèle
            $data = [
                'description' => $description,
                'category' => $category,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'photo_url' => $photo
            ];

            // Ajouter des valeurs par défaut pour les champs manquants
            $data['utilisateur_id'] = 1; // Exemple : ID utilisateur par défaut
            $data['titre'] = 'Signalement'; // Exemple : Titre par défaut

            // Appeler le modèle pour enregistrer les données
            $signalement = new Signalement();
            $result = $signalement->ajouterSignalement($data);

            // Rediriger ou afficher un message selon le résultat
            if ($result) {
                header('Location: index.php?action=success');
            } else {
                header('Location: index.php?action=error');
            }
        }
    }
}
