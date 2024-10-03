<?php
// Vérifier si la session n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Démarrer la session si aucune session n'est active
}

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}
?>
