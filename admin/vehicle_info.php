<?php
include_once("../menu/menu.php");
include_once("../database/database.php");
include_once("../fonction/fonction.php");

if (isset($_GET["vehicle_uuid"])) {
    $vehicle_uuid = $_GET["vehicle_uuid"];

    // Requête pour récupérer les informations du véhicule
    $query = "
        SELECT v.uuid AS vehicle_uuid, v.license_plate, v.capacity, v.description, v.qr_code_path,
               v.fuel_type, v.created_at, v.num_vehicles, v.status, 
               d.firstname AS driver_firstname, d.lastname AS driver_lastname,
               v.is_deleted AS vehicle_is_deleted, d.is_deleted AS driver_is_deleted
        FROM vehicles v
        LEFT JOIN drivers d ON v.driver_uuid = d.uuid
        WHERE v.uuid = :vehicle_uuid AND v.is_deleted = 0 AND d.is_deleted = 0
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':vehicle_uuid', $vehicle_uuid, PDO::PARAM_STR);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vehicle) {
        // Format de la date de création
        $vehicle_created_at = date("d-m-Y H:i:s", strtotime($vehicle['created_at']));
    } else {
        echo "Aucun véhicule trouvé.";
    }
}
?>

<div class="main-container mt-3 pb-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <h6 class="text-uppercase font-14">Informations du véhicule</h6>
            <?php if (isset($vehicle)): ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Numéro de Plaque</th>
                        <td><?php echo htmlspecialchars($vehicle['license_plate']); ?></td>
                    </tr>
                    <tr>
                        <th>Capacité</th>
                        <td><?php echo htmlspecialchars($vehicle['capacity']); ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo htmlspecialchars($vehicle['description']); ?></td>
                    </tr>
                    <tr>
                        <th>Type de Carburant</th>
                        <td><?php echo htmlspecialchars($vehicle['fuel_type']); ?></td>
                    </tr>
                    <tr>
                        <th>Date de Création</th>
                        <td><?php echo $vehicle_created_at; ?></td>
                    </tr>
                    <tr>
                        <th>Nombre de Véhicules</th>
                        <td><?php echo htmlspecialchars($vehicle['num_vehicles']); ?></td>
                    </tr>
                    <tr>
                        <th>Statut</th>
                        <td><?php echo htmlspecialchars($vehicle['status']); ?></td>
                    </tr>
                    <tr>
                        <th>Nom du Chauffeur</th>
                        <td><?php echo htmlspecialchars($vehicle['driver_firstname']) . " " . htmlspecialchars($vehicle['driver_lastname']); ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
