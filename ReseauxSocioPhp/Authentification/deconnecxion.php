<?php
session_start(); // Démarrer la session
session_unset();  // Supprime toutes les variables de session
session_destroy(); // Détruire toutes les données de session
header("Location: ../index.php"); // Rediriger vers la page de connexion
exit();
?>