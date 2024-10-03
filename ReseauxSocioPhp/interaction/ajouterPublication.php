<?php
session_start();
include '../ConnectionBD/config.php'; // Connexion à la base de données

if (isset($_POST['publication'])) {
    // Nettoyage et validation de l'entrée
    $publication = trim(htmlspecialchars($_POST['publication']));

    // Vérifier que le contenu n'est pas vide
    if (empty($publication)) {
        echo "Le contenu de la publication ne peut pas être vide.";
        exit;
    }

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $idCompte = $_SESSION['user_id'];

        try {
            // Insertion de la publication dans la base de données avec la date
            $sql = "INSERT INTO publications (idCompte, contenue, dateHeurePub) VALUES (:idCompte, :contenue, NOW())";
            $stmt = $connecxion->prepare($sql);
            $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
            $stmt->bindParam(':contenue', $publication, PDO::PARAM_STR);

            // Vérifier si l'insertion est réussie
            if ($stmt->execute()) {
                // Récupérer les informations de la publication nouvellement insérée
                $publicationId = $connecxion->lastInsertId();

                // Sélection des informations associées à la publication et à l'utilisateur
                $sql = "SELECT p.dateHeurePub, c.nom, c.prenoms, 
                               (SELECT COUNT(*) FROM reactionPublications r WHERE r.idPublication = p.id AND r.Reaction = 'aime') AS totalLikes,
                               (SELECT COUNT(*) FROM reactionPublications r WHERE r.idPublication = p.id AND r.Reaction = 'nonAime') AS totalDislikes,
                               (SELECT COUNT(*) FROM reactionPublications r WHERE r.idPublication = p.id AND r.Reaction = 'hahaha') AS totalHaha,
                               (SELECT COUNT(*) FROM reactionPublications r WHERE r.idPublication = p.id AND r.Reaction = 'adore') AS totalLoves
                        FROM publications p
                        JOIN compte c ON p.idCompte = c.id
                        WHERE p.id = :idPublication AND c.id = :idCompte";
                $stmt = $connecxion->prepare($sql);
                $stmt->bindParam(':idPublication', $publicationId, PDO::PARAM_INT);
                $stmt->bindParam(':idCompte', $idCompte, PDO::PARAM_INT);
                $stmt->execute();

                $publicationData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($publicationData) {
                    // Afficher la publication ajoutée avec les informations de l'utilisateur
                    echo '
                    <div class="publication" id="publication-' . htmlspecialchars($publicationId) . '">
                        <div class="headerPub">
                            <div class="image">
                                <img src="../image/avatar/homme.png" alt="pub" />
                                <p>' . htmlspecialchars($publicationData['nom']) . ' ' . htmlspecialchars($publicationData['prenoms']) . '</p>
                                <div class="date">' . htmlspecialchars($publicationData['dateHeurePub']) . '</div>
                            </div>
                            <div class="optionpublication">
                                <button onclick="modifierPublication(' . htmlspecialchars($publicationId) . ')">
                                    <img src="../image/fonction/write-svgrepo-com.svg" alt="Modifier" />
                                </button>
                                <button onclick="supprimerPublication(' . htmlspecialchars($publicationId) . ')">
                                    <img src="../image/fonction/delete-1487-svgrepo-com.svg" alt="Supprimer" />
                                </button>
                            </div>
                        </div>
                        <div class="contenuepub">
                            <p>' . htmlspecialchars($publication) . '</p>
                        </div>
                        <div class="reactionpub">
                            <div class="reaction">
                                <button id="likeButton-' . htmlspecialchars($publicationId) . '" onclick="ajouterReaction(' . htmlspecialchars($publicationId) . ', \'aime\')">
                                    <div class="like">
                                        <img src="../image/reaction/like-svgrepo-com.svg" alt="like" />
                                        <div id="comptlike-' . htmlspecialchars($publicationId) . '">' . htmlspecialchars($publicationData['totalLikes']) . '</div>
                                    </div>
                                </button>
                                <button id="dislikeButton-' . htmlspecialchars($publicationId) . '" onclick="ajouterReaction(' . htmlspecialchars($publicationId) . ', \'nonAime\')">
                                    <div class="dislike">
                                        <img src="../image/reaction/dislike-svgrepo-com (1).svg" alt="dislike" />
                                        <div id="comptdislike-' . htmlspecialchars($publicationId) . '">' . htmlspecialchars($publicationData['totalDislikes']) . '</div>
                                    </div>
                                </button>
                                <button id="hahaButton-' . htmlspecialchars($publicationId) . '" onclick="ajouterReaction(' . htmlspecialchars($publicationId) . ', \'hahaha\')">
                                    <div class="Haha">
                                        <img src="../image/reaction/facebook-haha-logo-svgrepo-com.svg" alt="haha" />
                                        <div id="compthaha-' . htmlspecialchars($publicationId) . '">' . htmlspecialchars($publicationData['totalHaha']) . '</div>
                                    </div>
                                </button>
                                <button id="loveButton-' . htmlspecialchars($publicationId) . '" onclick="ajouterReaction(' . htmlspecialchars($publicationId) . ', \'adore\')">
                                    <div class="love">
                                        <img src="../image/reaction/love-1489-svgrepo-com.svg" alt="love" />
                                        <div id="comptlove-' . htmlspecialchars($publicationId) . '">' . htmlspecialchars($publicationData['totalLoves']) . '</div>
                                    </div>
                                </button>
                            </div>
                            <button>
                                <div class="commentaire">
                                    <img src="../image/fonction/comment-3-svgrepo-com.svg" alt="commentaire" />
                                    <div id="comptcomment-' . htmlspecialchars($publicationId) . '">0</div>
                                </div>
                            </button>
                        </div>
                    </div>';
                } else {
                    echo "Erreur lors de la récupération des données de la publication.";
                }
            } else {
                echo "Erreur lors de l'ajout de la publication.";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Vous devez être connecté pour publier.";
    }
}

?>
