<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Compte</title>
</head>

<body>

<?php
session_start(); // Démarrer la session

include '../ConnectionBD/config.php'; // Inclure le fichier de configuration de la base de données
include '../TestSession/testSs.php'; // Inclure le fichier pour tester la session (si nécessaire)

if (isset($_SESSION['user_id'])) {
    // Récupérer l'ID de l'utilisateur connecté à partir de la session
    $id = $_SESSION['user_id'];

    // Préparer une requête pour récupérer les détails de l'utilisateur
    $sql = "SELECT * FROM compte WHERE id = :id";
    $stmti = $connecxion->prepare($sql);
    $stmti->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Exécuter la requête
    $stmti->execute();

    // Récupérer les résultats
    $utilisateur = $stmti->fetch(PDO::FETCH_ASSOC);

    // Si l'utilisateur existe
    if ($utilisateur) {
        echo "<p><strong>Nom :</strong> " . htmlspecialchars($utilisateur['nom']) . "</p>";
        echo "<p><strong>Prénoms :</strong> " . htmlspecialchars($utilisateur['prenoms']) . "</p>";
        echo "<p><strong>Email :</strong> " . htmlspecialchars($utilisateur['email']) . "</p>";
    } else {
        echo "Aucun utilisateur trouvé avec cet ID.";
    }
} else {
    echo "Aucun utilisateur n'est connecté.";
}
?>
</body>

</html>
