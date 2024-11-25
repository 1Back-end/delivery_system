<?php
// Inclure les fichiers nécessaires pour la connexion à la base de données
include_once("../database/database.php");

if (isset($_GET['uuid']) && isset($_GET['status'])) {
    $uuid = $_GET['uuid'];
    $status = $_GET['status'];

    try {
        // Préparer la requête pour mettre à jour le statut
        $query = "UPDATE languages SET is_active = :status WHERE uuid = :uuid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        // Message de succès
        $message = ($status == 1) ? "La langue a été activée avec succès." : "La langue a été désactivée avec succès.";
        $message_type = "success";  // Indique que c'est un message de succès
    } catch (Exception $e) {
        // Message d'erreur
        $message = "Une erreur est survenue lors de la mise à jour de la langue.";
        $message_type = "error";  // Indique qu'il y a eu une erreur
    }

    // Rediriger avec le message et son type
    header("Location: language.php?message=" . urlencode($message) . "&type=" . urlencode($message_type));
    exit();
}
?>
