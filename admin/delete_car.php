
<?php
include_once("../database/database.php");

if (isset($_GET["vehicle_uuid"])) {
    $vehicle_uuid = $_GET["vehicle_uuid"];

    $query = "UPDATE vehicles SET is_deleted = 1 WHERE uuid = :vehicle_uuid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':vehicle_uuid', $vehicle_uuid);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: car.php?message=Véhicules supprimé avec succès");
        exit(); // Toujours ajouter exit après un header pour arrêter l'exécution du script
        # code...
    }else {
        header("Location: car.php?message=Erreur lors de la suppression du véhicule");
        exit();
        # code...
    }
    # code...
}else {
    header("Location: car.php?message=Veuillez sélectionner un véhicule");
    exit();
    # code...
}