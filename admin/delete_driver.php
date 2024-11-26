<?php
include_once("../database/database.php");

if (isset($_GET["driver_uuid"])) {
    $driver_uuid = $_GET["driver_uuid"];

    // Requête pour marquer le chauffeur comme supprimé
    $query = "UPDATE drivers SET is_deleted = 1 WHERE uuid = :driver_uuid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":driver_uuid", $driver_uuid, PDO::PARAM_STR);
    $stmt->execute();

    // Vérifier si la suppression a été effectuée
    if ($stmt->rowCount() > 0) {
        header("Location: drivers.php?message=Chauffeur supprimé avec succès");
        exit(); // Toujours ajouter exit après un header pour arrêter l'exécution du script
    } else {
        header("Location: drivers.php?message=Erreur lors de la suppression du chauffeur");
        exit();
    }
} else {
    // Si l'identifiant du chauffeur est manquant dans l'URL
    header("Location: drivers.php?message=Identifiant du chauffeur manquant");
    exit();
}
