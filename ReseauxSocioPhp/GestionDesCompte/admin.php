<?php
include '../ConnectionBD/config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un Compte</title>
    <link rel="stylesheet" href="../front/style/cree.css">
</head>

<body>

    <div class="main">
        <div class="contenue">
            <div class="logo">
                <h2>Créer une Compte</h2>
            </div><br>

            <form method="POST" action="../GestionDesCompte/ajout.php">
                <label>Nom:</label>
                <input type="text" name="nom" required><br><br>

                <label>Prénoms:</label>
                <input type="text" name="prenoms" required><br><br>

                <label>email:</label>
                <input type="email" name="email" required><br><br>


                <label>Mots de passe:</label>
                <input type="password" name="mdp" required><br><br><br>
                <div class="contentInput">
                    <input type="submit" name="ajouter" value="Créer" class="input">
                </div>

            </form> <br>
            <form action="../index.php">
                <div class="connect">
                    <button type="submit">Connecter</button>
                </div>
            </form><br>
        </div>


    </div>

</body>

</html>