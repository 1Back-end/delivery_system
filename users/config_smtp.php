<?php
// config_smtp.php

return [
    'host' => 'smtp.gmail.com',  // Le serveur SMTP
    'username' => 'laurentalphonsewilfried@gmail.com', // Votre adresse email
    'password' => 'ztgs elyg jaxy emnx',  // Votre mot de passe email
    'SMTPSecure' => 'tls',  // Chiffrement TLS (utiliser une chaîne au lieu de PHPMailer::ENCRYPTION_STARTTLS)
    'port' => 587,  // Port SMTP pour TLS
    'from' => 'laurentalphonsewilfried@gmail.com',  // Adresse email de l'expéditeur
    'from_name' => 'ColisTrack',  // Nom de l'expéditeur
];
