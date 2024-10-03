<?php
$host = 'localhost';
$dbname = 'ReseauxSocio';
$username = 'freddy';
$password = '1598753.Freddy#';

try {
    // Connecxion à la base de données en utilisant PDO
    $connecxion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    //Définir le mode d'erreur de PDO sur Exception
    $connecxion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erreur) {
    //Gestion de erreurs
    echo "Erreur de connexion : " . $erreur->getMessage();
    die();
}

// Récupérer tous les compte de la base de données
$stmti = $connecxion->query("SELECT * FROM compte");
$utilisateurs = $stmti->fetchAll(PDO::FETCH_ASSOC);
?>