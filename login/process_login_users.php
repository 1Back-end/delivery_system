<?php

include_once("../database/database.php");

session_start();

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;

    // Vérifier si les champs sont remplis
    if (empty($email) || empty($password)) {
        $erreur_champ = "Ce champ est requis !";
    } else {
        try {
            // Vérifier si l'utilisateur existe
            $sql = "SELECT *
                    FROM users 
                    WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $erreur = "Email ou mot de passe incorrect.";
            } elseif ($user['is_active'] != 0 || $user['is_deleted'] != 0) {
                // Vérifie si is_active ou is_deleted n'est pas égal à 0
                $erreur = "Ce compte est soit désactivé, soit supprimé.";
            } elseif (!password_verify($password, $user['password'])) {
                $erreur = "Email ou mot de passe incorrect.";
            } else {
                // Vérification pour les expéditeurs uniquement
                if (
                    $user['role'] === 'expediteur' &&
                    (empty($user['photo']) || empty($user['region']) || empty($user['ville']) || empty($user['quartier']))
                ) {
                    // Redirection vers le formulaire pour compléter le compte
                    $_SESSION['uuid'] = $user['uuid']; // Garder l'identifiant en session
                    header("Location: ../users/complete_profile.php");
                    exit;
                }

                // Définir les sessions séparées pour l'utilisateur
                $_SESSION['fullname'] = $user['firstname'] . ' ' . $user['lastname'];
                $_SESSION['uuid'] = $user['uuid'];
                $_SESSION['photo'] = $user['photo'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Rediriger en fonction du rôle
                if ($user['role'] === 'admin') {
                    header("Location: ../admin/dashboard.php");
                } elseif ($user['role'] === 'expediteur') {
                    header("Location: ../users/dashboard.php");
                } else {
                    header("Location: login.php");
                }
                exit;
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de la connexion : " . $e->getMessage();
        }
    }
}
?>
