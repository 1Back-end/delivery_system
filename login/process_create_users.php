<?php

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur_champ = "";
$erreur = "";
$success = "";

// // Activer les erreurs PDO pour détecter les problèmes
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"] ?? null;
    $lastname = $_POST["lastname"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone_number = $_POST["phone_number"] ?? null;
    $password = $_POST["password"] ?? null;

    // Générer UUID et numéro utilisateur
    $uuid = generateUUID4();
    $num_users = generateUserUUID();

    // Afficher les données récupérées pour débogage
    // var_dump([
    //     'firstname' => $firstname,
    //     'lastname' => $lastname,
    //     'email' => $email,
    //     'phone_number' => $phone_number,
    //     'password' => $password,
    //     'uuid' => $uuid,
    //     'num_users' => $num_users,
    // ]);

    // Nettoyer le numéro de téléphone (supprimer les espaces)
    $phone_number = str_replace(' ', '', $phone_number);

    // Vérification des champs vides
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone_number) || empty($password)) {
        $erreur_champ = "Ce champ est requis !";
    } elseif (!preg_match('/^\d{9}$/', $phone_number)) { // Vérifie que le numéro est exactement 9 chiffres
        $erreur = "Le numéro de téléphone doit contenir exactement 9 chiffres.";
    } else {
        // Ajouter le préfixe +237 au numéro de téléphone
        $phone_number = '+237' . $phone_number;

        try {
            // Vérification si l'email ou le numéro de téléphone existe déjà
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email OR phone_number = :phone_number";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':phone_number' => $phone_number,
            ]);
            $exists = $stmt->fetchColumn();

            if ($exists > 0) {
                $erreur = "Cet email ou numéro de téléphone existe déjà.";
            } else {
                // Hacher le mot de passe
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insérer l'utilisateur
                $sql = "INSERT INTO users (uuid, firstname, lastname, email, phone_number, password, num_users, created_at) 
                        VALUES (:uuid, :firstname, :lastname, :email, :phone_number, :password, :num_users, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':uuid' => $uuid,
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':email' => $email,
                    ':phone_number' => $phone_number,
                    ':password' => $hashed_password,
                    ':num_users' => $num_users,
                ]);

                $success = "Votre compte a été créé avec succès.";
                header("Refresh:2; url=login.php");
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

?>
