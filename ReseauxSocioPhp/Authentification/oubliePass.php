<?php
session_start();
include '../ConnectionBD/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM compte WHERE email = :email";
    $stmt = $connecxion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Générer un nouveau mot de passe (ici, 123456)
        $nouveauMdp = '123456';
        $nouveauMdpHash = password_hash($nouveauMdp, PASSWORD_DEFAULT); // Hacher le nouveau mot de passe

        // Mettre à jour le mot de passe dans la base de données
        $sqlUpdate = "UPDATE compte SET mdp = :mdp WHERE email = :email";
        $stmtUpdate = $connecxion->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':mdp', $nouveauMdpHash);
        $stmtUpdate->bindParam(':email', $email);
        $stmtUpdate->execute();

        // Envoyer un email pour informer l'utilisateur du changement de mot de passe
        $sujet = "Votre mot de passe a été réinitialisé";
        $message = "Bonjour " . $user['nom'] . ",\n\nVotre mot de passe a été réinitialisé. Votre nouveau mot de passe est : 123456.\nVeuillez vous connecter et changer ce mot de passe dès que possible.\n\nMerci.";
        $headers = 'From: noreply@votre-site.com' . "\r\n" .
                   'Reply-To: noreply@votre-site.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if (mail($email, $sujet, $message, $headers)) {
            echo "Un email vous a été envoyé avec votre nouveau mot de passe.";
        } else {
            echo "Erreur lors de l'envoi de l'email.";
        }
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
</head>
<body>
    <h2>Réinitialiser votre mot de passe</h2>
    <form method="POST" action="">
        <label>Email :</label>
        <input type="email" name="email" required><br><br>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
</body>
</html>
