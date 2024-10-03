<?php
session_start();
include '../ConnectionBD/config.php';

if (isset($_POST['publicationId'])) {
    $publicationId = intval($_POST['publicationId']);
    
    // Supprimer la publication de la base de données
    $sql = "DELETE FROM publications WHERE id = :id";
    $stmt = $connecxion->prepare($sql);
    $stmt->bindParam(':id', $publicationId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Publication supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la publication.";
    }
}
?>
