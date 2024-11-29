<?php
include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur_champ = "";  // Variable pour le message d'erreur lié au champ
$erreur = "";        // Variable pour les autres erreurs (par exemple, email non trouvé)
$success = "";       // Variable pour les messages de succès

// Vérifier si le formulaire de mot de passe oublié a été soumis
if (isset($_POST["btn_forgot_password"])) {
    // Récupérer et nettoyer l'email
    $email = trim($_POST["email"]);

    // Vérifier si l'email est vide
    if (empty($email)) {
        // Si l'email est vide, afficher un message d'erreur pour le champ
        $erreur_champ = "Veuillez entrer un email valide.";
    } else {
        // Si l'email n'est pas vide, vérifier s'il existe dans la base de données
        $query = "SELECT * FROM users WHERE email = :email AND is_deleted = 0";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Vérifier si un utilisateur avec cet email existe
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Si l'utilisateur existe, rediriger vers la page reset_password.php avec le uuid
            header("Location: reset_password.php?uuid=" . $user['uuid']);
            exit;
        } else {
            // Si l'email n'existe pas dans la base de données
            $erreur = "L'email que vous avez saisi n'est pas associé à un compte.";
        }
    }
}
?>