<?php

include_once("../database/database.php");
include_once("../fonction/fonction.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Inclure PHPMailer's autoload

// Inclure le fichier de configuration SMTP
$smtpConfig = require 'config_smtp.php';

if (isset($_GET["package_uuid"])) {
    // Récupérer le package_uuid depuis l'URL
    $package_uuid = $_GET['package_uuid'];

    // Récupérer les informations du colis
    $query = "
        SELECT 
            p.uuid AS package_uuid,
            p.sender_uuid,
            p.receiver_uuid,
            u1.firstname AS sender_firstname,
            u1.lastname AS sender_lastname,
            u1.email AS sender_email,
            u1.phone_number AS sender_phone,
            u2.firstname AS receiver_firstname,
            u2.lastname AS receiver_lastname,
            u2.email AS receiver_email,
            u2.phone_number AS receiver_phone
        FROM packages p
        JOIN users u1 ON p.sender_uuid = u1.uuid
        JOIN users u2 ON p.receiver_uuid = u2.uuid
        WHERE p.uuid = :package_uuid
        AND p.is_deleted = 0;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':package_uuid', $package_uuid);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($package) {
        // Récupérer les informations du destinataire et de l'expéditeur
        $sender_name = $package['sender_firstname'] . ' ' . $package['sender_lastname'];
        $sender_email = $package['sender_email'];
        $sender_phone = $package['sender_phone'];

        $receiver_name = $package['receiver_firstname'] . ' ' . $package['receiver_lastname'];
        $receiver_email = $package['receiver_email'];
        $receiver_phone = $package['receiver_phone'];

        // Configurer PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Serveur SMTP
            $mail->isSMTP();
            $mail->Host = $smtpConfig['host'];  // Utiliser la configuration depuis config_smtp.php
            $mail->SMTPAuth = true;
            $mail->Username = $smtpConfig['username'];  // Utiliser la configuration depuis config_smtp.php
            $mail->Password = $smtpConfig['password'];  // Utiliser la configuration depuis config_smtp.php
            $mail->SMTPSecure = $smtpConfig['SMTPSecure'];  // Utiliser la configuration depuis config_smtp.php
            $mail->Port = $smtpConfig['port'];  // Utiliser la configuration depuis config_smtp.php

            // Destinataire
            $mail->setFrom($smtpConfig['from'], $smtpConfig['from_name']);  // Utiliser la configuration depuis config_smtp.php
            $mail->addAddress($receiver_email, $receiver_name); // Ajouter l'email du destinataire
            $mail->addReplyTo($sender_email, $sender_name); // Répondre à l'expéditeur

            // Contenu du mail
            $mail->isHTML(true);
            $mail->Subject = 'Notification de colis en attente de livraison';
            $mail->CharSet = 'UTF-8';

            $mail->Body    = "
                <h3>Bonjour $receiver_name,</h3>
                <p>Nous vous informons que votre colis avec le code de suivi <strong>{$package['package_code']}</strong> 
                est en cours de livraison.</p>
                <p>Expéditeur : $sender_name<br>
                Contact : $sender_phone<br>
                Email : $sender_email</p>
                <p>Vous pouvez suivre l'évolution de votre colis via notre plateforme.</p>
                <p>Cordialement,<br>Votre Service de Livraison</p>
            ";

            // Envoi de l'email
            $mail->send();
            header("Location: mes_colis.php?message=Notification envoyée au destinataire.");
            exit(); // Toujours ajouter exit après un header pour arrêter l'exécution du script
        } catch (Exception $e) {
            header("Location: mes_colis.php?message=Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}");
            exit();
        }
    } else {
        header("Location: mes_colis.php?message=Aucun colis trouvé avec ce code.");
        exit();
    }
}
?>
