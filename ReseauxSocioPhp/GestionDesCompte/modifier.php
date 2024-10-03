<?php
include '../ConnectionBD/config.php';
include '../TestSession/testSs.php';

if (isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à modifier
    $id = $_GET['id'];

    // Préparer une requête pour récupérer les informations de l'utilisateur
    $stmti = $connecxion->prepare("SELECT * FROM compte WHERE id = :id");
    $stmti->execute(['id' => $id]);
    $compte = $stmti->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe
    if (!$compte) {
        echo "Compte non trouvé!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mettre à jour les informations de l'utilisateur
    $nom = $_POST['nom'];
    $prenoms = $_POST['prenoms'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Si un nouveau mot de passe est saisi, le hacher avant de l'enregistrer
    if (!empty($mdp)) {
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
    } else {
        // Si aucun nouveau mot de passe n'est saisi, garder l'ancien
        $mdpHash = $compte['mdp'];
    }

    // Requête de mise à jour
    $stmti = $connecxion->prepare("UPDATE compte SET 
        nom = :nom, 
        prenoms = :prenoms, 
        email = :email, 
        mdp = :mdp 
        WHERE id = :id");

    // Exécuter la requête avec les valeurs
    $stmti->execute([
        'nom' => $nom,
        'prenoms' => $prenoms,
        'email' => $email,
        'mdp' => $mdpHash, // Utilise le nouveau mot de passe haché ou l'ancien
        'id' => $id
    ]);

    // Rediriger après la mise à jour
    header("Location: ../Authentification/acceuil.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier information de Compte</title>
    <link rel="stylesheet" href="../front/style/cree.css">
</head>

<body>
    <div class="main">
        <div class="contenue">
            <div class="logo">
                <h2>Modifier les informations de Compte</h2>
            </div> <br><br>
            <form method="POST" action="">

                <label>Nom:</label>
                <input type="text" name="nom" value="<?php echo htmlspecialchars($compte['nom']); ?>" required><br><br>

                <label>Prénoms:</label>
                <input type="text" name="prenoms" value="<?php echo htmlspecialchars($compte['prenoms']); ?>" required><br><br>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($compte['email']); ?>" required><br><br>

                <label>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
                <input type="password" name="mdp"><br><br>
                <div class="contentInput">
                    <input type="submit" value="Mise à jour" class="input"><br><br>
                </div><br>
                <form action="../index.php">
                    <div class="connect">
                        <button type="submit">Annuler</button>
                    </div>
                </form><br>
            </form><br>
        </div>

    </div>


</body>

</html>