<?php
require_once __DIR__ . '/../../Models/Signalement.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Signalements</title>
    <link rel="stylesheet" href="../../Public/css/signale.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Gestion des Signalements</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Tableau de Bord</a></li>
                <li><a href="admin_signalements.php" class="active">Signalements</a></li>
            </ul>
        </nav>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Photo URL</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Type de Problème</th>
                        <th>Statut</th>
                        <th>Date de Signalement</th>
                        <th>Actions</th>
                        <th>Traiter</th>
                        <th>Filtrer</th>
                        <th>Classer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les signalements depuis la base de données
                    $signalementModel = new Signalement();
                    $signalements = $signalementModel->getTousLesSignalements();

                    foreach ($signalements as $signalement) {
                        echo "<tr>";
                        echo "<td>{$signalement['id']}</td>";
                        echo "<td>{$signalement['utilisateur_id']}</td>";
                        echo "<td>{$signalement['titre']}</td>";
                        echo "<td>{$signalement['description']}</td>";
                        echo "<td>{$signalement['photo_url']}</td>";
                        echo "<td>{$signalement['latitude']}</td>";
                        echo "<td>{$signalement['longitude']}</td>";
                        echo "<td>{$signalement['type_probleme']}</td>";
                        echo "<td>{$signalement['statut']}</td>";
                        echo "<td>{$signalement['date_signalement']}</td>";
                        echo "<td>";
                        echo "<a href='../../Controllers/SignalementController.php?action=valider&id={$signalement['id']}'>Valider</a> | ";
                        echo "<a href='../../Controllers/SignalementController.php?action=rejeter&id={$signalement['id']}'>Rejeter</a>";
                        echo "</td>";
                        echo "<td><a href='../../Controllers/SignalementController.php?action=traiter&id={$signalement['id']}'>Traiter</a></td>";
                        echo "<td><a href='../../Controllers/SignalementController.php?action=filtrer'>Filtrer</a></td>";
                        echo "<td><a href='../../Controllers/SignalementController.php?action=classer'>Classer</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
