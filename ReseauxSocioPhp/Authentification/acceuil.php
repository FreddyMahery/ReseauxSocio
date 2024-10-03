<?php
include '../TestSession/testSs.php';
include '../ConnectionBD/config.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../front/style/style.css" />
    <title>Acceuil</title>
</head>

<body>
    <div class="entete">
        <div class="logo">
            <h2>Bienvenue</h2>
        </div>
        <div class="deconnecxion">
            <form action="../Authentification/deconnecxion.php" method="post">
                <button type="submit"><h3>Déconnexion</h3></button>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="corps">
            <div class="aproposCompte">
                <div class="profil">
                    <img src="../image/avatar/homme.png" alt="Profil" />
                </div>
                <div class="NomPrenom">
                    <?php include '../GestionDesCompte/details.php'; ?>
                </div>
                <div class="modifCompte">
                    <form method="GET" action="../GestionDesCompte/modifier.php">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>">
                        <button type="submit">
                            <img src="../image/fonction/write-svgrepo-com (1).svg" alt="" srcset="">
                            <p>Modifier le compte</p>
                        </button>
                    </form>
                </div>
                <div class="suppCompte">
                    <form method="GET" action="../GestionDesCompte/supprimer.php">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user_id']; ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet compte ?');">
                            <img src="../image/fonction/delete-1487-svgrepo-com.svg" alt="" srcset="">
                            <p>Supprimer le compte</p>
                        </button>
                    </form>
                </div>
                <div class="listeCompte">
                    <form action="../GestionDesCompte/liste.php">
                        <button type="submit">
                            <img src="../image/fonction/eye-see-show-svgrepo-com.svg" alt="" srcset="">
                            <p>Comptes existant</p>
                        </button>
                    </form>
                </div>
            </div>
            <div class="contenuepublication">
                <div class="Ajoutpub">
                    <form id="publicationForm" action="../interaction/ajouterPublication.php" method="POST">
                        <textarea id="publication" name="publication" placeholder="Écrire ici la publication" required></textarea>
                        <div class="option">
                            <button type="submit">Publier</button>
                        </div>
                    </form>
                </div>
                <div id="lesPublications">
                    <!-- Les publications apparaîtront ici -->
                    <!-- <div class="publication">
                        <div class="headerPub">
                            <div class="image">
                                <img src="../image/avatar/homme.png" alt="pub" />
                                <p>'($publication['nom']) $publication(['prenoms']) </p>
                                <div class="date"></div>
                            </div>
                            <div class="optionpublication">
                                <button id="mididier">
                                    <img src="../image/fonction/write-svgrepo-com.svg" alt="options" />
                                </button>
                                <button id="supprimer">
                                    <img src="../image/fonction/delete-1487-svgrepo-com.svg" alt="options" />
                                </button>
                            </div>
                        </div>
                        <div class="contenuepub">
                            <p>' . htmlspecialchars($publication['contenue']) . '</p>
                        </div>
                        <div class="reactionpub">
                            <div class="reaction">
                                <button id="likeButton" onclick="toggleLike()">
                                    <div class="like">
                                        <img id="likeImage" src="../image/reaction/like-svgrepo-com.svg" alt="like" />
                                        <div id="comptlike">0</div>
                                    </div>
                                </button>

                                <button id="dislikeButton" onclick="toggleDislike()">
                                    <div class="dislike">
                                        <img id="dislikeImage" src="../image/reaction/dislike-svgrepo-com (1).svg" alt="dislike" />
                                        <div id="comptdislike">0</div>
                                    </div>
                                </button>

                                <button id="hahaButton" onclick="toggleHaha()">
                                    <div class="Haha">
                                        <img id="hahaImage" src="../image/reaction/facebook-haha-logo-svgrepo-com.svg" alt="haha" />
                                        <div id="compthaha">0</div>
                                    </div>
                                </button>

                                <button id="loveButton" onclick="toggleLove()">
                                    <div class="love">
                                        <img id="loveImage" src="../image/reaction/love-1489-svgrepo-com.svg" alt="love" />
                                        <div id="comptlove">0</div>
                                    </div>
                                </button>
                            </div>
                            <button>
                                <div class="commentaire"><img src="../image/fonction/comment-3-svgrepo-com.svg" alt="commentaire" />
                                    <div id="comptcomment">0</div>
                                </div>
                            </button>
                        </div>
                    </div> -->
                    <?php
                    include '../interaction/voirPublication.php'
                    ?>
                </div>

            </div>

        </div>
    </div>
    <script src="../Js/traitementPublication.js"></script>

</body>

</html>