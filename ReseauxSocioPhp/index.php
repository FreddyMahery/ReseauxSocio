<?php
session_start(); // Démarrer la session

include './ConnectionBD/config.php'; // Inclure le fichier de configuration de la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM compte WHERE email = :email";
    $stmti = $connecxion->prepare($sql);
    $stmti->bindParam(':email', $email);
    $stmti->execute();
    $user = $stmti->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mdp, $user['mdp'])) {
        // Si l'utilisateur est trouvé et que le mot de passe est correct
        $_SESSION['user'] = $user['email'];
        $_SESSION['admin'] = $user['nom']; // On stocke le nom de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id']; // Stocker l'ID de l'utilisateur dans la session
        header("Location: ./Authentification/acceuil.php");
        exit();
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="./front/style/index.css">
</head>

<body>
    <div class="main">
        <div class="contenue">
            <div class="logo"><h1>Reseaux Socio</h1></div><br>
            <form method="POST" action="">
                <input type="email" name="email" required placeholder="  Adress e-mail" autocomplete="off" ><br><br>
                <input type="password" name="mdp" required placeholder="  Mot de passe" autocomplete="off"><br><br>
                <div class="boutton">
                    <button type="submit">Se connecter</button><br><br>
                    <div class="lien">
                    <a href="./Authentification/oubliePass.php" class="btn-link">Mot de passe oublié ?</a>
                    </div><br>
                    <hr> 
                    <br><br>
                </div>
                <div class="compt">
                <button type="button" onclick="location.href='./GestionDesCompte/admin.php'">Créer nouveau compte</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>