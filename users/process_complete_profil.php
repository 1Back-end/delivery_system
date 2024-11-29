<?php
session_start();

// Vérifiez si l'utilisateur est connecté et a un UUID dans la session
if (!isset($_SESSION['uuid'])) {
    header("Location: ../login/login.php");
    exit;
}

// Inclure votre fichier de connexion à la base de données
include_once("../database/database.php");

// Récupérer les informations de l'utilisateur actuel
$uuid = $_SESSION['uuid'];
$sql = "SELECT * FROM users WHERE uuid = :uuid";
$stmt = $pdo->prepare($sql);
$stmt->execute([':uuid' => $uuid]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'utilisateur n'existe pas
if (!$user) {
    header("Location: ../login/login.php");
    exit;
}

$success = "";
$erreur = "";
$erreur_champ = "";

// Vérifiez si le formulaire est soumis
if (isset($_POST['submit'])) {
    // Récupérer les données soumises
    $photo = $_FILES['photo'] ?? $user['photo'];
    $region = $_POST['region'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $quartier = $_POST['quartier'] ?? null;

    // Vérifier si les champs obligatoires sont remplis
    if (empty($region) || empty($ville) || empty($quartier)) {
        $erreur_champ  = "Veuillez remplir tous les champs obligatoires.";
    } else {
        // Gérer le téléchargement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $uploadDir = "../uploads/users/"; // Répertoire où les photos seront stockées

            // Créer le répertoire 'users' s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Crée le répertoire avec les permissions nécessaires
            }

            // Obtenir le nom du fichier et le sécuriser
            $photoName = basename($_FILES['photo']['name']);
            $photoPath = $uploadDir . $photoName;

            // Vérifier le type de fichier (optionnel, selon vos besoins)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['photo']['type'], $allowedTypes)) {
                $erreur = "Seuls les fichiers image (JPEG, PNG, GIF) sont autorisés.";
            } else {
                // Déplacer la photo téléchargée dans le répertoire
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                    // Mettre à jour les informations dans la base de données
                    $update_sql = "
                        UPDATE users 
                        SET photo = :photo, region = :region, ville = :ville, quartier = :quartier
                        WHERE uuid = :uuid
                    ";
                    $update_stmt = $pdo->prepare($update_sql);
                    $update_stmt->execute([
                        ':photo' => $photoName,  // Enregistrer seulement le nom du fichier dans la base de données
                        ':region' => $region,
                        ':ville' => $ville,
                        ':quartier' => $quartier,
                        ':uuid' => $uuid
                    ]);

                    $success = "Profil mis à jour avec succès !";

                    // Après la mise à jour réussie, rediriger vers le dashboard
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $erreur = "Erreur lors du téléchargement de la photo.";
                }
            }
        } else {
            // Si la photo n'a pas été changée, mettre à jour uniquement les autres champs
            $update_sql = "
                UPDATE users 
                SET region = :region, ville = :ville, quartier = :quartier
                WHERE uuid = :uuid
            ";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->execute([
                ':region' => $region,
                ':ville' => $ville,
                ':quartier' => $quartier,
                ':uuid' => $uuid
            ]);

            $success = "Profil mis à jour avec succès !";

            // Après la mise à jour réussie, rediriger vers le dashboard
            header("Location: dashboard.php");
            exit;
        }
    }
}
?>
