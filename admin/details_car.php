<?php
// Inclusion des fichiers nécessaires
include_once("../menu/menu.php");
include_once("../database/database.php");
include_once("../fonction/fonction.php");

if (isset($_GET["vehicle_uuid"])) {
    $vehicle_uuid = $_GET["vehicle_uuid"];

    // Requête SQL pour récupérer les informations du véhicule
    $query = "
        SELECT v.uuid AS vehicle_uuid, v.license_plate, v.capacity, v.description, v.qr_code_path,
               v.fuel_type, v.created_at, v.num_vehicles, v.status, 
               d.firstname AS driver_firstname, d.lastname AS driver_lastname, d.email AS driver_email,d.phone as driver_phone,
               d.num_drivers as driver_num,d.created_at as driver_created_at,
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
        $driver_created_at = date("d-m-Y H:i:s", strtotime($vehicle['driver_created_at']));
    } else {
        // echo "Aucun véhicule trouvé.";
    }
}
?>

<div class="main-container mt-3 pb-3">
    <?php if(empty($vehicle)): ?>
        <div class="alert alert-warning" role="alert">
            Aucun véhicule trouvé.
        </div>
    <?php else:?>

    <div class="row p-2">
        <!-- QR Code Section (col-lg-3) -->
        <div class="col-lg-3 col-sm-12 mb-3 text-center">
            <div class="card-box p-3">
                <h6 class="text-uppercase font-14">Code QR</h6>
                <img src="../uploads/qrcodes/<?php echo $vehicle['qr_code_path']; ?>" alt="QR Code" style="width: 200px; height: 200px;">
            </div>
        </div>



        <div class="col-lg-9 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="row">
            <!-- Vehicle Information (Left Section) -->
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-2">
                    <h6 class="text-uppercase font-14">Informations du Véhicule</h6>
                </div>
                <div class="mb-2">
                    <p><strong>Immatriculation : </strong><?php echo htmlspecialchars($vehicle['num_vehicles']); ?></p>
                </div>
                <div class="mb-2">
                    <p><strong>Carburant : </strong><?php echo htmlspecialchars($vehicle['fuel_type']); ?></p>
                </div>
                <div class="mb-2">
                    <p><strong>Capacité : </strong><?php echo htmlspecialchars($vehicle['capacity']); ?></p>
                </div>
                <div class="mb-2">
                    <p><strong>Disponibilité : </strong><?php echo htmlspecialchars($vehicle['status']); ?></p>
                </div>
                <div class="mb-2">
                    <p><strong>Créé le : </strong><?php echo $vehicle_created_at; ?></p>
                </div>
            </div>

            <!-- Driver Information (Right Section) -->
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-2">
                    <h6 class="text-uppercase font-14">Informations du chauffeur</h6>
                </div>

                <div class="mb-2">
                    <?php if(empty($vehicle["driver_num"])): ?>
                        <p><strong>Code : </strong>Non renseigné</p>
                    <?php else:?>
                        <p><strong>Code : </strong><?php echo htmlspecialchars($vehicle['driver_num']); ?></p>
                    <?php endif;?>
                </div>

                <div class="mb-2">
                    <p><strong>Nom Complet : </strong><?php echo htmlspecialchars($vehicle['driver_firstname']) . ' ' . htmlspecialchars($vehicle['driver_lastname']); ?></p>
                </div>
                <div class="mb-2">
                        <?php if(empty($vehicle["driver_email"])): ?>
                            <p><strong>Email : </strong>Non renseigné</p>
                        <?php else:?>
                            <p><strong>Email : </strong><?php echo htmlspecialchars($vehicle['driver_email']); ?></p>
                        <?php endif;?>
                </div>
                <div class="mb-2">
                    <?php if(empty($vehicle["driver_phone"])): ?>
                        <p><strong>Téléphone : </strong>Non renseigné</p>
                    <?php else:?>
                        <p><strong>Téléphone : </strong><?php echo htmlspecialchars($vehicle['driver_phone']); ?></p>
                    <?php endif;?>
                </div>
                <div class="mb-2">
                    <?php if(empty($vehicle["driver_created_at"])): ?>
                        <p><strong>Créé le : </strong>Non renseigné</p>
                    <?php else:?>
                        <p><strong>Créé le : </strong><?php echo $driver_created_at;?>
                        <?php endif;?>
                </div>
                

                
            </div>
        </div>
    </div>
</div>


        

    <?php endif; ?>
</div>
