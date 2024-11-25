<?php
include_once("../database/database.php");

if (isset($_GET["uuid"])) {
    $uuid_warehouse = $_GET["uuid"];

    // Préparer la requête pour désactiver l'entrepôt
    $query = "UPDATE warehouses SET status = 'inactive' WHERE uuid = :uuid_warehouse";
    $stmt = $pdo->prepare($query);

    try {
        // Lier le paramètre UUID
        $stmt->bindParam(":uuid_warehouse", $uuid_warehouse, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();

        // Vérifier si une ligne a été mise à jour
        if ($stmt->rowCount() > 0) {
            // Redirection avec un message de succès
            header("Location: warehouses.php?message=Entrepôt désactivé avec succès");
        } else {
            // Aucun entrepôt trouvé avec cet UUID
            header("Location: warehouses.php?message=Entrepôt introuvable");
        }
    } catch (PDOException $e) {
        // Redirection avec un message d'erreur spécifique
        header("Location: warehouses.php?message=Erreur lors de la désactivation : " . $e->getMessage());
    }
} else {
    // Si l'UUID n'est pas défini, rediriger avec un message d'erreur
    header("Location: warehouses.php?message=Identifiant d'entrepôt manquant");
}
exit;
?>
