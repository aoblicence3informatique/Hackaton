<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur</title>
    <link rel="stylesheet" href="../../Public/css/inscription.css">
</head>
<body>
    <div class="register-container">
        <h1>Inscription</h1>
        <form action="../../Controllers/UtilisateurController.php?action=register" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="text" id="telephone" name="telephone">
            </div>
            <div class="form-group">
                <label for="role">Rôle :</label>
                <select id="role" name="role_id" required>
                    <option value="1">Utilisateur</option>
                    <option value="2">Administrateur</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
    </div>
</body>
</html>
