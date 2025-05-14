<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-header {
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .dashboard-nav {
            display: flex;
            justify-content: space-around;
            background-color: #34495e;
            padding: 10px;
            width: 100%;
        }

        .dashboard-nav a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .dashboard-nav a:hover {
            background-color: #1abc9c;
        }

        .content {
            width: 90%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #2c3e50;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1>Tableau de Bord Administrateur</h1>
    </div>
    <nav class="dashboard-nav">
        <a href="admin_signalements.php"><i class="fas fa-flag"></i> Signalements</a>
        <a href="admin_utilisateurs.php"><i class="fas fa-users"></i> Utilisateurs</a>
        <a href="admin_statistiques.php"><i class="fas fa-chart-bar"></i> Statistiques</a>
        <a href="../index.php        php composer.phar install"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
    </nav>
    <div class="content">
        <h2>Statistiques</h2>
        <p>Graphiques et indicateurs clés à venir...</p>
    </div>
    <div class="content">
        <h2>Signalements Récents</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Exemple de signalement</td>
                    <td>Route</td>
                    <td>En attente</td>
                    <td>2025-05-14</td>
                </tr>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2025 Projet Hackathon. Tous droits réservés.</p>
    </footer>
</body>
</html>
