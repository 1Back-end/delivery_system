<?php

include_once("../database/database.php");

if (isset($_GET["user_uuid"])) {
    $user_uuid = $_GET["user_uuid"];

    $query = "UPDATE users SET is_active = 1 WHERE uuid = :user_uuid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_uuid', $user_uuid);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: user_management.php?message= Utilisateur désactivé avec succès");
        exit();
        # code...
    }else {
        header("Location: user_management.php?message= Une erreur est survenue lors de la désactivation de l'utilisateur");
        exit();
        # code...
    }
    # code...
}else {
    header("Location: user_management.php?message= Identifiant de l'utilisateur manquant");
    exit();
    # code...
}