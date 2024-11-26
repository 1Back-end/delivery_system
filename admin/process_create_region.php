<?php
include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";
$erreur_champ = "";

if (isset($_POST["btn_add_region"])) {
    $region_name = $_POST["region_name"] ?? null;
    $uuid = generateUUID4() ?? null;

    if (empty($region_name)) {
        $erreur_champ = "Le nom de la région ne peut pas être vide.";
    } else {
        // Vérifier si la région existe déjà
        $sqlCheckRegion = "SELECT * FROM regions WHERE name = :region_name";
        $stmt = $pdo->prepare($sqlCheckRegion);
        $stmt->execute([':region_name' => $region_name]);
        $existingRegion = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRegion) {
            $erreur = "Cette région existe déjà.";
        } else {
            // Insérer la nouvelle région
            $sqlInsertRegion = "INSERT INTO regions (uuid, name) VALUES (:uuid, :region_name)";
            $stmt = $pdo->prepare($sqlInsertRegion);
            $stmt->execute([':uuid' => $uuid, ':region_name' => $region_name]);

            if ($stmt->rowCount() > 0) {
                $success = "Région ajoutée avec succès.";
            } else {
                $erreur = "Erreur lors de l'ajout de la région.";
            }
        }
    }
}
?>
