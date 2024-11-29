<?php
include_once("../database/database.php"); // Connexion à la base de données
include_once("../fonction/fonction.php"); // Fonctions personnalisées

$erreur_champ = ""; // Message d'erreur pour les champs
$erreur = ""; // Message d'erreur général
$success = ""; // Message de succès

if (isset($_POST["btn_reset_password"])) {
    // Récupérer les valeurs du formulaire
    $new_password = $_POST["c_password"] ?? null;
    $confirm_password = $_POST["c1_password"] ?? null;
    $user_uuid = $_GET["uuid"] ?? null; // Récupérer le uuid de l'utilisateur depuis l'URL

    // Vérification si l'utilisateur existe (en s'assurant qu'il existe dans la base de données)
    if ($user_uuid) {
        $query = "SELECT * FROM users WHERE uuid = :uuid AND is_deleted = 0";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':uuid', $user_uuid);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $erreur = "Utilisateur non trouvé.";
        }
    }

    // Vérification si les champs sont remplis
    if (empty($new_password) || empty($confirm_password)) {
        $erreur_champ = "Les deux champs de mot de passe doivent être remplis.";
    } elseif ($new_password !== $confirm_password) {
        // Vérification si les mots de passe correspondent
        $erreur_champ = "Les mots de passe ne correspondent pas.";
    } else {
        // Si tout est valide, on met à jour le mot de passe dans la base de données
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT); // Hash du mot de passe

        // Requête pour mettre à jour le mot de passe de l'utilisateur
        $update_query = "UPDATE users SET password = :password WHERE uuid = :uuid";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->bindParam(':password', $hashed_password);
        $update_stmt->bindParam(':uuid', $user_uuid);

        if ($update_stmt->execute()) {
            $success = "Votre mot de passe a été réinitialisé avec succès.";
            header("Refresh:3; url=login.php");
        } else {
            $erreur = "Erreur lors de la réinitialisation du mot de passe. Veuillez réessayer.";
        }
    }
    // echo $user_uuid;
}
?>
