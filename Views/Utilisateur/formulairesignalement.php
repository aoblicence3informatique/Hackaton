<link rel="stylesheet" href="../../Public/css/fairessignalement.css">

<h2>Signaler un problème</h2>
<form action="../../Public/index.php?action=store" method="POST" enctype="multipart/form-data">
    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>

    <label>Catégorie:</label><br>
    <select name="category">
        <option value="Route">Route endommagée</option>
        <option value="Électricité">Panne électrique</option>
        <option value="Déchets">Déchets non collectés</option>
    </select><br>

    <label>Photo (facultatif):</label><br>
    <input type="file" name="photo"><br>

    <label>Latitude:</label><br>
    <input type="text" name="latitude" required><br>

    <label>Longitude:</label><br>
    <input type="text" name="longitude" required><br>

    <button type="submit">Soumettre</button>
</form>
