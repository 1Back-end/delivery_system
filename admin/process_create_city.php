<?php
include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";
$erreur_champ = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST["btn_add_city"])) {
    // Récupérer les données envoyées par le formulaire
    $region_uuid = $_POST["region_uuid"] ?? null;
    $ville_name = $_POST["ville"] ?? null;

    // Validation des données
    if (empty($region_uuid) || empty($ville_name)) {
        $erreur_champ = "Ce champ est réquis !";
    } else {
        // Vérifier si la ville existe déjà dans la région spécifiée
        $sqlCheckCity = "SELECT * FROM cities WHERE name = :ville_name AND region_uuid = :region_uuid";
        $stmt = $pdo->prepare($sqlCheckCity);
        $stmt->execute([':ville_name' => $ville_name, ':region_uuid' => $region_uuid]);
        $existingCity = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCity) {
            $erreur = "Cette ville existe déjà dans la région sélectionnée.";
        } else {
            // Générer un UUID pour la nouvelle ville
            $uuid = generateUUID4();

            // Insérer la nouvelle ville dans la base de donné<es></es>
            $sqlInsertCity = "INSERT INTO cities (uuid, name, region_uuid) VALUES (:uuid, :ville_name, :region_uuid)";
            $stmt = $pdo->prepare($sqlInsertCity);
            $stmt->execute([
                ':uuid' => $uuid,
                ':ville_name' => $ville_name,
                ':region_uuid' => $region_uuid
            ]);

            // Vérifier si l'insertion a réussi
            if ($stmt->rowCount() > 0) {
                $success = "Ville ajoutée avec succès.";
            } else {
                $erreur = "Erreur lors de l'ajout de la ville.";
            }
        }
    }
}

