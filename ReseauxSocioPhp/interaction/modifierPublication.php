<?php
session_start();
include '../ConnectionBD/config.php';

if (isset($_POST['publicationId']) && isset($_POST['nouveauContenu'])) {
    $publicationId = intval($_POST['publicationId']);
    $nouveauContenu = htmlspecialchars($_POST['nouveauContenu']);
    
    // Modifier le contenu de la publication dans la base de données
    $sql = "UPDATE publications SET contenue = :contenue WHERE id = :id";
    $stmt = $connecxion->prepare($sql);
    $stmt->bindParam(':contenue', $nouveauContenu, PDO::PARAM_STR);
    $stmt->bindParam(':id', $publicationId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "Publication modifiée avec succès.";
    } else {
        echo "Erreur lors de la modification de la publication.";
    }
}
?>
