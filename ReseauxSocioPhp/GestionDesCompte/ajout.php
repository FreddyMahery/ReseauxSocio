<!DOCTYPE html>
<html>
<head>
    <title>Reponse d'ajout</title>
</head>
<body>
<?php
include '../ConnectionBD/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le bouton "Ajouter" a été soumis
    if (isset($_POST['ajouter'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenoms = $_POST['prenoms'];
        $email = $_POST['email'];
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe


        // Préparer la requête SQL avec des placeholders pour la sécurité (PDO)
        $sql = "INSERT INTO compte (nom, prenoms, email, mdp) 
                VALUES (:nom, :prenoms, :email, :mdp)";

        // Préparer la requête avec PDO
        $stmti = $connecxion->prepare($sql);

        // Lier les valeurs aux placeholders pour éviter les injections SQL
        $stmti->bindParam(':nom', $nom);
        $stmti->bindParam(':prenoms', $prenoms);
        $stmti->bindParam(':email', $email);
        $stmti->bindParam(':mdp', $mdp);
       
        // Exécuter la requête
        if ($stmti->execute()) {
            // Rediriger ou afficher un message de succès
            echo "<h1>Le Compte a été ajouté avec succès.</h1>";
        } else {
            // Gérer les erreurs
            echo "<h1>Une erreur s'est produite lors de l'ajout de compte.</h1>";
        }
    }
}
?>
<form action="../index.php">
    <button type="submit">Connecter</button>
</form>

</body>
</html>

