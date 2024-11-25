<?php
session_start();
include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $name = $_POST["name"] ?? null;
    $address = $_POST["address"] ?? null;
    $capacity = $_POST["capacity"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $email = $_POST["email"] ?? null;
    $logo = $_FILES["logo"] ?? null;
    $uuid = generateUUID4();
    $num_warehouses = generateWarehouseCode();
    $added_by = $_SESSION["uuid"] ?? null;

    // Vérifier si tous les champs sont remplis
    if (empty($name) || empty($added_by) || empty($address) || empty($phone) || empty($email) || empty($uuid) || empty($num_warehouses)) {
        $erreur_champ = "Veuillez remplir tous les champs requis.";
    } else {
        try {
            // Vérifier si un entrepôt avec le même nom existe déjà
            $sql = "SELECT * FROM warehouses WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name' => $name]);
            $existingWarehouse = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingWarehouse) {
                $erreur = "Un entrepôt avec ce nom existe déjà.";
            } else {
                $file_name = null; // Initialiser le nom du fichier à null par défaut

                // Vérifier si un logo a été téléchargé
                if ($logo && !empty($logo["name"])) {
                    // Traitement du logo (upload)
                    $target_dir = "../uploads/"; // Répertoire pour stocker les logos
                    $file_name = basename($logo["name"]);
                    $target_file = $target_dir . $file_name;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

                    // Vérifier l'extension du fichier
                    if (!in_array($imageFileType, $allowed_types)) {
                        $erreur = "Le fichier doit être une image (JPG, JPEG, PNG, GIF).";
                    } else {
                        // Déplacer le fichier vers le répertoire de destination
                        if (!file_exists($target_file)) {
                            if (!move_uploaded_file($logo["tmp_name"], $target_file)) {
                                $erreur = "Désolé, une erreur est survenue lors du téléchargement du logo.";
                            }
                        }
                    }
                }

                // Insertion de l'entrepôt dans la base de données
                $sqlInsert = "INSERT INTO warehouses (uuid, name, address, capacity, phone, email, logo, num_warehouses, added_by) 
                              VALUES (:uuid, :name, :address, :capacity, :phone, :email, :logo, :num_warehouses, :added_by)";
                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->execute([
                    ':uuid' => $uuid,
                    ':name' => $name,
                    ':address' => $address,
                    ':capacity' => $capacity,
                    ':phone' => $phone,
                    ':email' => $email,
                    ':logo' => $file_name, // Enregistrer le nom du fichier (peut être null)
                    ':num_warehouses' => $num_warehouses,
                    ':added_by' => $added_by
                ]);

                $success = "L'entrepôt a été ajouté avec succès!";
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            $erreur = "Erreur lors de l'ajout de l'entrepôt : " . $e->getMessage();
        }
    }
}
?>
