<?php

require '../vendor/autoload.php'; // Inclure QRCode
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
// use Twilio\Rest\Client;

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";
$erreur_champ="";

// Fonction pour exécuter la requête avec bindValue
function executeQueryWithBindValue($sql, $params) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key + 1, $value); // bindValue uses 1-based index for placeholders
    }
    return $stmt->execute();
}

// Fonction pour récupérer l'UUID par email
function getUserUUID($email) {
    global $pdo;
    $sql = "SELECT uuid FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['uuid'];
    }
    return null;
}

// Fonction pour récupérer les détails d'un utilisateur
function getUserDetails($user_uuid) {
    global $pdo;
    $sql = "SELECT firstname, lastname, phone_number,email FROM users WHERE uuid = :uuid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':uuid', $user_uuid, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}
// Fonction pour envoyer un SMS
// function sendSMS($toPhoneNumber, $message) {
//     // Vos identifiants Twilio
//     $sid = 'AC5e86826b62fec0b7077f1836acda7fbe';
//     $token = '375e900e5120acd7d028689bb5b69e00';
   
//     $client = new Client($sid, $token);

//     try {
//         $client->messages->create("+237678536884", // to
//             array(
//             "from" => "+17753707076",
//             'body' => $message // Le message à envoyer
//         ));
//     } catch (Exception $e) {
//         echo 'Erreur lors de l\'envoi du SMS : ' . $e->getMessage();
//     }
// }

if (isset($_POST["btn_add_packages"])) {
    // Récupération et validation des champs
    // Récupération et validation des champs
    $last_name = trim($_POST["last_name"]) ?? null;
    $first_name = trim($_POST["first_name"]) ?? null;
    $email = trim($_POST["email"]) ?? null;
    $phone_number = trim($_POST["phone_number"]) ?? null;

    // Vérification des champs potentiellement non définis
    $region_uuid = isset($_POST["region_uuid"]) ? trim($_POST["region_uuid"]) : null;
    $city_uuid = isset($_POST["city_uuid"]) ? trim($_POST["city_uuid"]) : null;
    $neighborhood_uuid = isset($_POST["neighborhood_uuid"]) ? trim($_POST["neighborhood_uuid"]) : null;
    $package_type = isset($_POST["package_type"]) ? trim($_POST["package_type"]) : null;
    $weight = isset($_POST["weight"]) ? trim($_POST["weight"]) : null;
    $dimensions = isset($_POST["dimensions"]) ? trim($_POST["dimensions"]) : null;
    $content_description = isset($_POST["content_description"]) ? trim($_POST["content_description"]) : null;
    $declared_value = isset($_POST["declared_value"]) ? trim($_POST["declared_value"]) : null;
    $declared_value = trim($_POST["declared_value"]) ?? null;

    if (empty($last_name) || empty($first_name) || empty($email) || empty($phone_number) || empty($region_uuid) || empty($city_uuid) || empty($neighborhood_uuid) || empty($package_type) || empty($weight)) {
        $erreur_champ = "Tous les champs sont obligatoires.";
    }else {
        # code...
   
    
        // Vérification si l'utilisateur existe déjà par email
        $receiver_uuid = getUserUUID($email);
        $receiver_role = "destinataire";

        if (!$receiver_uuid) {
            // L'utilisateur n'existe pas, on va le créer
            $receiver_uuid = generateUUID4(); // Générer un UUID pour l'utilisateur
            $sql_insert_user = "INSERT INTO users (uuid, firstname, lastname, email, phone_number, role) VALUES (?, ?, ?, ?, ?,?)";
            $stmt = $pdo->prepare($sql_insert_user);
            $stmt->bindValue(1, $receiver_uuid);
            $stmt->bindValue(2, $first_name);
            $stmt->bindValue(3, $last_name);
            $stmt->bindValue(4, $email);
            $stmt->bindValue(5, $phone_number);
            $stmt->bindValue(6, $receiver_role);
            if (!$stmt->execute()) {
                $erreur = "Erreur lors de l'enregistrement du destinataire.";
            }
        }

        // Gestion de l'image
        $package_image = null;
        if (!empty($_FILES["package_image"]["name"])) {
            $upload_dir = "../uploads/packages/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $image_name = time() . "_" . basename($_FILES["package_image"]["name"]);
            $image_path = $upload_dir . $image_name;

            if (move_uploaded_file($_FILES["package_image"]["tmp_name"], $image_path)) {
                $package_image = $image_name;
            } else {
                $erreur = "Erreur lors du téléchargement de l'image.";
            }
        }

        if (empty($erreur)) {
            // Insertion du colis
            $uuid = generateUUID4();
            $package_code = generateParcelCode();
            $tracking_number = generateTrackingNumber();
            $sender_uuid = $_SESSION["uuid"];

            // Insérer le colis avec l'UUID du destinataire récupéré ou créé
            $sql_insert_package = "INSERT INTO packages (uuid, sender_uuid, receiver_uuid, weight, dimensions,tracking_number, package_type, package_image, content_description, declared_value, region_uuid, city_uuid, neighborhoods_uuid, package_code) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_package = $pdo->prepare($sql_insert_package);
            $stmt_package->bindValue(1, $uuid);
            $stmt_package->bindValue(2, $sender_uuid);
            $stmt_package->bindValue(3, $receiver_uuid);
            $stmt_package->bindValue(4, $weight);
            $stmt_package->bindValue(5, $dimensions);
            $stmt_package->bindValue(6, $tracking_number);
            $stmt_package->bindValue(7, $package_type);
            $stmt_package->bindValue(8, $package_image);
            $stmt_package->bindValue(9, $content_description);
            $stmt_package->bindValue(10, $declared_value);
            $stmt_package->bindValue(11, $region_uuid);
            $stmt_package->bindValue(12, $city_uuid);
            $stmt_package->bindValue(13, $neighborhood_uuid);
            $stmt_package->bindValue(14, $package_code);

            if (!$stmt_package->execute()) {
                $erreur = "Erreur lors de l'enregistrement du colis.";
            }

            // Récupération des informations du destinataire et de l'expéditeur
            $sender_details = getUserDetails($sender_uuid); // Détails de l'expéditeur
            $receiver_details = getUserDetails($receiver_uuid); // Détails du destinataire

            if ($sender_details && $receiver_details) {
                $sender_name = $sender_details['firstname'] . " " . $sender_details['lastname'];
                $sender_contact = $sender_details['phone_number'];
                $sender_email = $sender_details['email'];  // Assurez-vous que $sender_email est défini

                $receiver_name = $receiver_details['firstname'] . " " . $receiver_details['lastname'];
                $receiver_contact = $receiver_details['phone_number'];
                $receiver_email = $receiver_details['email'];  // Assurez-vous que $receiver_email est défini

                // Récupérer la date d'ajout du colis
                $date_added = date("d-m-Y H:i:s");

                // Génération du QR code avec les détails du colis
                // Génération du QR code avec les détails du colis
                $qr_content = "Informations du colis :\n";
                $qr_content .= "Code du colis : $package_code\n";
                $qr_content .= "Poids : $weight Kg\n";
                $qr_content .= "Type : $package_type\n";
                $qr_content .= "Valeur déclarée : $declared_value FRCFA\n\n";
                $qr_content .= "Numéro de suivi : $tracking_number\n";
                $qr_content .= "Dimensions : $dimensions\n";
                $qr_content .= "Description du contenu : $content_description\n";
                $qr_content .= "Date d'ajout : $date_added\n\n";
                $qr_content .= "Informations de l'expéditeur :\n";
                $qr_content .= "Nom complet : $sender_name\n";
                $qr_content .= "Email : $sender_email\n";  // Assurez-vous que $sender_email est défini
                $qr_content .= "Contact : $sender_contact\n\n";

                $qr_content .= "Informations du destinataire :\n";
                $qr_content .= "Nom complet : $receiver_name\n";
                $qr_content .= "Email : $receiver_email\n";  // Assurez-vous que $receiver_email est défini
                $qr_content .= "Contact : $receiver_contact";

                $qr_dir = "../uploads/qrcodes_colis/";
                if (!is_dir($qr_dir)) {
                    mkdir($qr_dir, 0777, true);
                }

                // Utilisation de l'UUID du colis comme nom de fichier pour le QR code
                $qr_filename = $uuid . ".png";
                $qr_path = $qr_dir . $qr_filename;

                // Création du QR code avec les nouvelles informations
                $options = new QROptions(['outputType' => QRCode::OUTPUT_IMAGE_PNG, 'eccLevel' => QRCode::ECC_L]);
                (new QRCode($options))->render($qr_content, $qr_path);

                // Mise à jour de la base de données pour enregistrer seulement le nom du fichier QR code
                $sql_update_qr_code = "UPDATE packages SET qr_code = ? WHERE uuid = ?";
                $stmt_update_qr = $pdo->prepare($sql_update_qr_code);
                $stmt_update_qr->bindValue(1, $qr_filename); // Enregistrer seulement le nom du fichier, pas le chemin complet
                $stmt_update_qr->bindValue(2, $uuid);
                $stmt_update_qr->execute();
                // $sms_message = "Vous avez recu un colis de la part de $sender_name dont le code est : $package_code. Suivi via: $tracking_number";
                // sendSMS($receiver_contact, $sms_message); // Envoi du SMS au destinataire

                $success = "Colis enregistré avec succès.";
            } else {
                $erreur = "Erreur lors de la récupération des détails de l'utilisateur.";
            }
        }
    }
}

?>


