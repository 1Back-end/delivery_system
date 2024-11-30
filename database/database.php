<?php
// Définir les paramètres de connexion
$host = 'localhost'; // Adresse du serveur
$dbname = 'delivery_system'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur pour la base de données
$password = ''; // Mot de passe de la base de données

// Créer la connexion avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie à la base de données";
} catch (PDOException $e) {
    // En cas d'erreur de connexion, consigner les détails dans un fichier de log
    error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . '/errors.log');
    
    // Afficher un message générique à l'utilisateur
    die("Une erreur s'est produite sur le serveur. Veuillez réessayer plus tard.");
}
?>
