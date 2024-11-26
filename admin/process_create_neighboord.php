<?php
include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";
$erreur_champ = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {
    // Récupérer les données envoyées par le formulaire
    $ville_uuid = $_POST["ville_uuid"] ?? null;
    $name = $_POST["name"] ?? null;
    $uuid = generateUUID4(); // Générer un UUID pour le quartier

    // Validation des champs
    if (empty($ville_uuid) || empty($name) || empty($uuid)) {
        $erreur_champ = "Veuillez remplir tous les champs requis."; 
    } else {
        // Connexion à la base de données
        try {
            
            // Vérifier si le quartier existe déjà pour cette ville
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM neighborhoods WHERE city_uuid = :city_uuid AND name = :name");
            $stmt->bindParam(':city_uuid', $ville_uuid);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                // Si le quartier existe déjà, afficher un message d'erreur
                $erreur = "Un quartier avec ce nom existe déjà dans cette ville.";
            } else {
                // Si le quartier n'existe pas, insérer le nouveau quartier
                $stmt = $pdo->prepare("INSERT INTO neighborhoods (uuid, name, city_uuid, created_at, updated_at) 
                                       VALUES (:uuid, :name, :city_uuid, NOW(), NOW())");
                $stmt->bindParam(':uuid', $uuid);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':city_uuid', $ville_uuid);
                $stmt->execute();

                $success = "Le quartier a été ajouté avec succès.";
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'ajout du quartier : " . $e->getMessage();
        }
    }
}
?>