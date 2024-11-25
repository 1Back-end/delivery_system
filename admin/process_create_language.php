<?php

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $code = $_POST["code"] ?? null;
    $name = $_POST["name"] ?? null;
    $flag_image = $_POST["flag_image"] ?? null;
    $uuid = generateUUID4();

    // Vérifier si tous les champs sont remplis
    if (empty($code) || empty($name) || empty($flag_image)) {
        $erreur_champ = $selected_lang['erreur_champ'];
    } else {
        try {
            // Vérifier si la langue avec le même code existe déjà
            $sql = "SELECT * FROM languages WHERE code = :code";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':code' => $code]);
            $existingLang = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingLang) {
                $erreur = $selected_lang['erreur_existant'];
            } else {
                // Insertion de la nouvelle langue dans la base de données
                $sqlInsert = "INSERT INTO languages (uuid, code, name, flag_image) VALUES (:uuid, :code, :name, :flag_image)";
                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->execute([
                    ':uuid' => $uuid,
                    ':code' => $code,
                    ':name' => $name,
                    ':flag_image' => $flag_image
                ]);
                
                // Message de succès
                $success = $selected_lang['success'];
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            $erreur = $selected_lang['erreur_db'] . $e->getMessage();
        }
    }
}
?>
