<?php
include '../TestSession/testSs.php';
include '../ConnectionBD/config.php'; // Connexion à la base de données

// Récupérer toutes les publications
$sql = "SELECT 
            p.id AS idPublication, p.contenue, p.nbrJaimeP, p.nbrNonJaimeP, p.nbrHahahaP, p.nbrJadoreP, p.dateHeurePub, 
            c.nom, c.prenoms, c.email,
            (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = p.id AND Reaction = 'aime') AS totalLikes,
            (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = p.id AND Reaction = 'nonAime') AS totalDislikes,
            (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = p.id AND Reaction = 'hahaha') AS totalHaha,
            (SELECT COUNT(*) FROM reactionPublications WHERE idPublication = p.id AND Reaction = 'adore') AS totalLoves
        FROM publications p 
        JOIN compte c ON p.idCompte = c.id 
        ORDER BY p.dateHeurePub DESC";

$stmt = $connecxion->prepare($sql);
$stmt->execute();
$publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher les publications
if ($publications) {
    foreach ($publications as $publication) {
        echo '<div class="publication" id="publication-' . htmlspecialchars($publication['idPublication']) . '">';
        echo '<div class="headerPub">';
        echo '<div class="image">';
        echo '<img src="../image/avatar/homme.png" alt="pub" />';
        echo '<p>' . htmlspecialchars($publication['nom']) . ' ' . htmlspecialchars($publication['prenoms']) . '</p>';
        echo '<div class="date">' . htmlspecialchars($publication['dateHeurePub']) . '</div>';
        echo '</div>'; // Fin de div.image
        echo '<div class="optionpublication">';
        echo '<button onclick="modifierPublication(' . htmlspecialchars($publication['idPublication']) . ')">';
        echo '<img src="../image/fonction/write-svgrepo-com.svg" alt="Modifier" />';
        echo '</button>';
        echo '<button onclick="supprimerPublication(' . htmlspecialchars($publication['idPublication']) . ')">';
        echo '<img src="../image/fonction/delete-1487-svgrepo-com.svg" alt="Supprimer" />';
        echo '</button>';
        echo '</div>'; // Fin de div.optionpublication
        echo '</div>'; // Fin de div.headerPub
        echo '<div class="contenuepub">';
        echo '<p>' . htmlspecialchars($publication['contenue']) . '</p>';
        echo '</div>'; // Fin de div.contenuepub
        echo '<div class="reactionpub">';
        echo '<div class="reaction">';
        echo '<button id="likeButton-' . htmlspecialchars($publication['idPublication']) . '" onclick="ajouterReaction(' . htmlspecialchars($publication['idPublication']) . ', \'aime\')">';
        echo '<div class="like">';
        echo '<img src="../image/reaction/like-svgrepo-com.svg" alt="like" />';
        echo '<div id="comptlike-' . htmlspecialchars($publication['idPublication']) . '">' . htmlspecialchars($publication['totalLikes']) . '</div>';
        echo '</div>'; // Fin de div.like
        echo '</button>';
        echo '<button id="dislikeButton-' . htmlspecialchars($publication['idPublication']) . '" onclick="ajouterReaction(' . htmlspecialchars($publication['idPublication']) . ', \'nonAime\')">';
        echo '<div class="dislike">';
        echo '<img src="../image/reaction/dislike-svgrepo-com (1).svg" alt="dislike" />';
        echo '<div id="comptdislike-' . htmlspecialchars($publication['idPublication']) . '">' . htmlspecialchars($publication['totalDislikes']) . '</div>';
        echo '</div>'; // Fin de div.dislike
        echo '</button>';
        echo '<button id="hahaButton-' . htmlspecialchars($publication['idPublication']) . '" onclick="ajouterReaction(' . htmlspecialchars($publication['idPublication']) . ', \'hahaha\')">';
        echo '<div class="Haha">';
        echo '<img src="../image/reaction/facebook-haha-logo-svgrepo-com.svg" alt="haha" />';
        echo '<div id="compthaha-' . htmlspecialchars($publication['idPublication']) . '">' . htmlspecialchars($publication['totalHaha']) . '</div>';
        echo '</div>'; // Fin de div.Haha
        echo '</button>';
        echo '<button id="loveButton-' . htmlspecialchars($publication['idPublication']) . '" onclick="ajouterReaction(' . htmlspecialchars($publication['idPublication']) . ', \'adore\')">';
        echo '<div class="love">';
        echo '<img src="../image/reaction/love-1489-svgrepo-com.svg" alt="love" />';
        echo '<div id="comptlove-' . htmlspecialchars($publication['idPublication']) . '">' . htmlspecialchars($publication['totalLoves']) . '</div>';
        echo '</div>'; // Fin de div.love
        echo '</button>';
        echo '</div>'; // Fin de div.reaction
        // Bouton commentaire
        echo '<button>';
        echo '<div class="commentaire">';
        echo '<img src="../image/fonction/comment-3-svgrepo-com.svg" alt="commentaire" />';
        echo '<div id="comptcomment">0</div>';
        echo '</div>'; // Fin de div.commentaire
        echo '</button>';
        echo '</div>'; // Fin de div.reactionpub
        echo '</div>'; // Fin de div.publication

    }
} else {
    echo 'Aucune publication trouvée.';
}
?>