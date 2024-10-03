<?php
include '../ConnectionBD/config.php';
include '../TestSession/testSs.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    try {
        // Récupérer l'ID de l'utilisateur à supprimer via GET
        $id = $_GET['id'];

        // Préparer la requête SQL avec un placeholder pour l'ID
        $sql = "DELETE FROM compte WHERE id = :id";
        $stmti = $connecxion->prepare($sql);

        // Lier la valeur de l'ID au placeholder
        $stmti->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmti->execute()){
            // Rediriger vers la page principale après suppression
            header("Location: liste.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de la suppression de compte.";
        }
    } catch (PDOException $erreur) {
        // Afficher l'erreur en cas d'exception
        echo "Erreur : " . $erreur->getMessage();
    }
} else 
{
    echo "Aucun ID spécifié pour la suppression.";
}
?>
