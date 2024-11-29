<?php

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["add_package_in_warehouse"])) {
    // Récupérer les données depuis le formulaire
    $package_uuid = $_POST["package_uuid"] ?? null;
    $warehouse_uuid = $_POST["warehouse_uuid"]?? null;
    $uuid = generateUUID4(); // Fonction pour générer un UUID unique
    $added_by = $_SESSION["uuid"] ?? null;

    // Validation des données
    if (!$package_uuid || !$warehouse_uuid || !$added_by) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {
        try {
            // 1. Insérer dans la table `package_warehouse`
            $query = "INSERT INTO `package_warehouse` (`uuid`, `package_uuid`, `warehouse_uuid`, `added_by`)
                      VALUES (:uuid, :package_uuid, :warehouse_uuid, :added_by)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':uuid' => $uuid,
                ':package_uuid' => $package_uuid,
                ':warehouse_uuid' => $warehouse_uuid,
                ':added_by' => $added_by
            ]);

            // 2. Mettre à jour le statut du colis dans la table `packages`
            $update_query = "UPDATE `packages` SET `status` = 'en cours' WHERE `uuid` = :package_uuid";
            $update_stmt = $pdo->prepare($update_query);
            $update_stmt->execute([
                ':package_uuid' => $package_uuid
            ]);

            // Message de succès
            $success = "Le colis a été affecté à l'entrepôt et son statut est désormais 'en cours'.";
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'ajout du colis à l'entrepôt : " . $e->getMessage();
        }
    }
}

?>
