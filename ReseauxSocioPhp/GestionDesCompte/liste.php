<?php
include '../ConnectionBD/config.php';
include '../TestSession/testSs.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des utilisateur</title>
    <link rel="stylesheet" href="../front/style/liste.css">
</head>
<body>

    <h2>Liste des utilisateur</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénoms</th>
          
        </tr>

        <?php foreach ($utilisateurs as $utilisateur) { ?>
            <tr>
                <td><?php echo $utilisateur['nom']; ?></td>
                <td><?php echo $utilisateur['prenoms']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <form action="../Authentification/acceuil.php">
        <button type="submit">Retour</button>
    </form><br>
 

</body>

</html>