<?php
include_once("../database/database.php");

if (isset($_GET["uuid"])) {
    $uuid_warehouse = $_GET["uuid"];

    // Préparer la requête pour marquer l'entrepôt comme supprimé
    $query = "UPDATE warehouses SET is_deleted = TRUE, deleted_at = NOW() WHERE uuid = :uuid_warehouse";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":uuid_warehouse", $uuid_warehouse, PDO::PARAM_STR);

    try {
        // Exécution de la requête
        $stmt->execute();

        // Redirection avec un message de succès
        header("Location: warehouses.php?msg=L'entrepôt a été supprimé avec succès.");
    } catch (PDOException $e) {
        // Redirection avec un message d'erreur
        header("Location: warehouses.php?msg=Erreur lors de la suppression de l'entrepôt.");
    }
    exit;
} else {
    // Si l'UUID n'est pas défini, rediriger avec un message d'erreur
    header("Location: warehouses.php?message=Identifiant d'entrepôt manquant.");
    exit;
}
?>
