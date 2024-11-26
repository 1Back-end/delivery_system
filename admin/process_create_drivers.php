<?php

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupération des données
    $uuid = generateUUID4();
    $num_drivers = generateDriverCode();
    $added_by = $_SESSION["uuid"] ?? null;
    $warehouse_uuid = $_POST["warehouse_uuid"] ?? null;
    $firstname = trim($_POST["firstname"] ?? "");
    $lastname = trim($_POST["lastname"] ?? "");
    $email = trim($_POST["email"] ?? null);
    $phone = trim($_POST["phone"] ?? "");
    $photo = $_FILES["photo"] ?? null;
    $photo_path = null; // Initialisation du chemin de la photo

    // Ajouter le préfixe par défaut pour le numéro de téléphone
    if (!empty($phone) && !str_starts_with($phone, "+237")) {
        $phone = "+237" . $phone;
    }

    // Validation des champs obligatoires
    if (empty($added_by) || empty($phone) || empty($warehouse_uuid) || empty($lastname) || empty($num_drivers) || empty($uuid)) {
        $erreur_champ = "Veuillez remplir tous les champs requis.";
    } elseif (!empty($email)) {
        // Vérification de l'unicité de l'email
        $check_email_query = "SELECT COUNT(*) FROM drivers WHERE email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $email_exists = $stmt->fetchColumn();

        if ($email_exists > 0) {
            $erreur = "Cet email est déjà utilisé.";
        }
    }

    // Validation de la photo
    if ($photo && $photo['error'] === 0) {
        $allowed_types = ['image/jpeg', 'image/png'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($photo['type'], $allowed_types)) {
            $erreur = "La photo doit être au format PNG ou JPEG.";
        } elseif ($photo['size'] > $max_size) {
            $erreur = "La photo ne doit pas dépasser 2MB.";
        } else {
            // Déplacer la photo dans un dossier de stockage
            $upload_dir = "../uploads/drivers/";
            if (!file_exists($upload_dir)) {
                // Crée le dossier ../uploads/drivers avec les permissions appropriées
                if (!mkdir($upload_dir, 0755, true)) {
                    $erreur = "Échec de la création du répertoire des photos.";
                }
            }

            if (empty($erreur)) {
                $photo_name = $uuid . "_" . basename($photo['name']);
                $photo_path = $upload_dir . $photo_name;

                // Déplacer le fichier dans le dossier
                if (!move_uploaded_file($photo['tmp_name'], $photo_path)) {
                    $erreur = "Échec du téléchargement de la photo.";
                }
            }
        }
    }

    // Enregistrement dans la base de données
    if (empty($erreur) && empty($erreur_champ)) {
        $insert_query = "
            INSERT INTO drivers (uuid, warehouse_uuid, firstname, lastname, phone, email, added_by, num_drivers, photo, is_deleted, created_at)
            VALUES (:uuid, :warehouse_uuid, :firstname, :lastname, :phone, :email, :added_by, :num_drivers, :photo, 0, NOW())
        ";

        // Préparer la requête avec la photo si elle existe
        $stmt = $pdo->prepare($insert_query);
        $stmt->bindParam(":uuid", $uuid);
        $stmt->bindParam(":warehouse_uuid", $warehouse_uuid);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":added_by", $added_by);
        $stmt->bindParam(":num_drivers", $num_drivers);
        $stmt->bindParam(":photo", $photo_path); // Si la photo a été téléchargée, son chemin sera stocké

        if ($stmt->execute()) {
            $success = "Le chauffeur a été ajouté avec succès.";
        } else {
            $erreur = "Erreur lors de l'enregistrement du chauffeur.";
        }
    }
}
?>
