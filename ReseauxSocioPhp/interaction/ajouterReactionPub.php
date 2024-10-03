<?php
session_start();
include '../ConnectionBD/config.php';

if (isset($_POST['publicationId'], $_POST['reaction']) && isset($_SESSION['user_id'])) {
    $idCompte = $_SESSION['user_id'];
    $idPublication = $_POST['publicationId'];
    $reaction = $_POST['reaction'];

    // Suppression des réactions précédentes de cet utilisateur pour cette publication
    $deleteSql = "DELETE FROM reactionPublications WHERE idCompte = :idCompte AND idPublication = :idPublication";
    $stmt = $connecxion->prepare($deleteSql);
    $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
    $stmt->bindParam(':idPublication', $idPublication, PDO::PARAM_INT);
    $stmt->execute();

    // Ajout de la nouvelle réaction
    $insertSql = "INSERT INTO reactionPublications (idCompte, idPublication, Reaction, dateHeureReaction)
                  VALUES (:idCompte, :idPublication, :reaction, NOW())";
    $stmt = $connecxion->prepare($insertSql);
    $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
    $stmt->bindParam(':idPublication', $idPublication, PDO::PARAM_INT);
    $stmt->bindParam(':reaction', $reaction, PDO::PARAM_STR);
    $stmt->execute();

    // Récupération des nouvelles réactions pour la publication
    $sql = "SELECT
                (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = :idPublication AND Reaction = 'aime') AS nbrJaimeP,
                (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = :idPublication AND Reaction = 'nonAime') AS nbrNonJaimeP,
                (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = :idPublication AND Reaction = 'hahaha') AS nbrHahahaP,
                (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = :idPublication AND Reaction = 'adore') AS nbrJadoreP
            FROM reactionPublications
            WHERE idPublication = :idPublication
            LIMIT 1";

    $stmt = $connecxion->prepare($sql);
    $stmt->bindParam(':idPublication', $idPublication, PDO::PARAM_INT);
    $stmt->execute();
    $reactions = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retour des réactions sous forme de JSON
    echo json_encode($reactions);
}
