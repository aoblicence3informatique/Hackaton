<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" href="../../Public/css/loginadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion Administrateur</h1>
        <form action="../../Public/index.php?controller=Admin&action=login" method="POST">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>

        <div class="extra-links">
            <a href="/admin/forgot-password"><i class="fas fa-unlock-alt"></i> Mot de passe oublié ?</a>
            <a href="/admin/register"><i class="fas fa-user-plus"></i> S'inscrire</a>
        </div>
    </div>
</body>
</html>
