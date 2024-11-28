<?php
require '../vendor/autoload.php'; // Inclure l'autoloader de Composer pour QRCode

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

include_once("../database/database.php");
include_once("../fonction/fonction.php");

$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'] ?? null;
    $vehicle_type_uuid = $_POST['vehicle_type_uuid'] ?? null;
    $fuel_type_uuid = $_POST['fuel_type_uuid'] ?? null;
    $capacity = $_POST['capacity'] ?? null;
    $driver_uuid = $_POST['driver_uuid'] ?? null;
    $description = $_POST['description'] ?? null;
    $uuid = generateUUID4(); // Fonction pour générer un UUID unique
    $num_vehicles = generateCarrierCode(); // Fonction pour générer un code véhicule
    $added_by = $_SESSION["uuid"] ?? null;
    
    // Validation des champs obligatoires
    if (empty($matricule) || empty($vehicle_type_uuid) || empty($fuel_type_uuid) || empty($capacity) || empty($driver_uuid) || empty($description)) {
        $erreur_champ = "Tous les champs sont obligatoires.";
    } else {
        // Récupérer les informations du chauffeur
        $driverInfo = $pdo->prepare("SELECT firstname, lastname, phone, email FROM drivers WHERE uuid = :driver_uuid AND is_deleted = 0");
        $driverInfo->execute(['driver_uuid' => $driver_uuid]);
        $driver = $driverInfo->fetch(PDO::FETCH_ASSOC);

        if (!$driver) {
            $erreur = "Chauffeur introuvable ou supprimé.";
        } else {
            // Définir le chemin du dossier pour les QR codes
            $qrCodeDirectory = "../uploads/qrcodes";

            // Vérifier si le dossier existe, sinon le créer
            if (!is_dir($qrCodeDirectory)) {
                mkdir($qrCodeDirectory, 0777, true);
            }

            // Définir le nom du fichier pour le QR code
            $qrCodeFilename = $uuid . ".png";  // Enregistrer uniquement le nom du fichier

            // Créer le QR code avec les informations du véhicule et du chauffeur
            $qrCodeData = "Matricule: $matricule\nType: $vehicle_type_uuid\nCarburant: $fuel_type_uuid\nCapacité: $capacity\nDescription: $description\n\n";
            $qrCodeData .= "Chauffeur:\nNom: {$driver['firstname']} {$driver['lastname']}\nTéléphone: {$driver['phone']}\nEmail: {$driver['email']}";

            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_L,
                'scale' => 5,
            ]);

            // Sauvegarder le QR code sous forme d'image
            $qrcode = new QRCode($options);
            $qrcode->render($qrCodeData, $qrCodeDirectory . "/" . $qrCodeFilename); // Sauvegarder l'image dans le dossier

            // Enregistrer les informations du véhicule dans la base de données
            $sql = "INSERT INTO vehicles (uuid, license_plate, fuel_type, capacity, driver_uuid, qr_code_path, num_vehicles, added_by, description) 
                    VALUES (:uuid, :license_plate, :fuel_type, :capacity, :driver_uuid, :qr_code_path, :num_vehicles, :added_by, :description)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'uuid' => $uuid,
                'license_plate' => $matricule,
                'fuel_type' => $fuel_type_uuid,
                'capacity' => $capacity,
                'driver_uuid' => $driver_uuid,
                'qr_code_path' => $qrCodeFilename, // Enregistrer uniquement le nom du fichier
                'num_vehicles' => $num_vehicles,
                'added_by' => $added_by,
                'description' => $description,
            ]);

            $success = "Véhicule enregistré avec succès et QR code généré.";
        }
    }
}
?>

