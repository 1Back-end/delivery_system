<?php
// Récupérer la clé secrète
$secretKey = "6LfK9IcqAAAAACxrcEGTZvW3CLqakU8-lycRAyl4";

// Récupérer la réponse de reCAPTCHA
$response = $_POST['g-recaptcha-response'];

// L'adresse IP de l'utilisateur
$remoteIp = $_SERVER['REMOTE_ADDR'];

// URL de l'API de Google pour vérifier reCAPTCHA
$verificationUrl = "https://www.google.com/recaptcha/api/siteverify";

// Paramètres à envoyer à l'API
$data = [
    'secret' => $secretKey,
    'response' => $response,
    'remoteip' => $remoteIp
];

// Effectuer la requête POST
$options = [
    'http' => [
        'method'  => 'POST',
        'content' => http_build_query($data),
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
    ]
];
$context = stream_context_create($options);
$result = file_get_contents($verificationUrl, false, $context);

// Décoder la réponse JSON
$responseKeys = json_decode($result);

// Vérifier si la vérification a réussi
if(intval($responseKeys->success) !== 1) {
    echo 'La vérification reCAPTCHA a échoué. Veuillez réessayer.';
} else {
    // reCAPTCHA validé, continuer avec l'enregistrement du compte
    echo 'Vérification réussie, enregistrement du compte en cours...';
}
?>
