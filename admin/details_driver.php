<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<?php
if (isset($_GET["driver_uuid"])) {
    $driver_uuid = $_GET["driver_uuid"] ?? null;
    // Requête SQL pour récupérer les détails du chauffeur, de l'entrepôt et de l'utilisateur qui a ajouté
    $query = "
    SELECT d.uuid AS driver_uuid, d.firstname, d.lastname, d.phone, d.email, d.num_drivers, d.created_at,
        w.name AS warehouse_name, w.logo AS warehouse_logo,w.address as warehouse_address, w.email as warehouse_email,w.phone as warehouse_phone,
        w.num_warehouses as warehouse_num,
        u.firstname AS added_by_firstname, u.lastname AS added_by_lastname
    FROM drivers d
    LEFT JOIN warehouses w ON d.warehouse_uuid = w.uuid
    LEFT JOIN users u ON d.added_by = u.uuid
    WHERE d.uuid = :driver_uuid AND d.is_deleted = 0
    ";

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":driver_uuid", $driver_uuid);
    $stmt->execute();

    // Récupérer les résultats
    $driver = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="main-container mt-3 pb-5">
    <?php if (empty($driver)): ?>
        <div class="alert alert-danger" role="alert">
            Aucune information trouvée
        </div>
    <?php else: ?>
        <div class="col-md-12 col-sm-12 mb-3">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <div class="card-box p-3">
                        <h5 class="mb-3 text-uppercase">Détails du Chauffeur</h5>
                        <p class="mb-4"><strong>Nom complet : </strong><?php echo htmlspecialchars($driver['firstname'] . ' ' . $driver['lastname']); ?></p>
                        <p class="mb-4"><strong>Contact : </strong><?php echo htmlspecialchars($driver['phone']); ?> | 
                            <?php if(empty($driver["email"])):?>
                                <span class="text-muted">Non renseigné</span>
                            <?php else:?>
                                <a class="font-14 font-weight-bold" href="mailto:<?php echo htmlspecialchars($driver["email"]);?>"><?php echo htmlspecialchars($driver["email"]);?></a>
                            <?php endif;?>
                        </p>
                        <p class="mb-4"><strong>Code : </strong><?php echo htmlspecialchars($driver['num_drivers']); ?></p>
                        <p class="mb-4"><strong>Ajouté par  : <?php echo htmlspecialchars($driver['added_by_firstname'] . ' ' . $driver['added_by_lastname']); ?> le </strong><?php echo htmlspecialchars($driver['created_at']); ?></p>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <div class="card-box p-3">
                        <h5 class="mb-3 text-uppercase">Détails de l'entrepôt</h5>
                        <p><strong>Nom  : </strong><?php echo htmlspecialchars($driver['warehouse_name']); ?></p>
                        <p><strong>Adresse : </strong><?php echo htmlspecialchars($driver['warehouse_address']); ?></p>
                        <p><strong>Contact : </strong><?php echo htmlspecialchars($driver['warehouse_phone']);?> | <?php echo htmlspecialchars($driver['warehouse_email']);?></p>
                        <p><strong>Code : </strong><?php echo htmlspecialchars($driver['warehouse_num']);?>
                        <p><strong>Ajouté par  : <?php echo htmlspecialchars($driver['added_by_firstname'] . ' ' . $driver['added_by_lastname']); ?> le </strong><?php echo htmlspecialchars($driver['created_at']); ?></p>
                        
                    </div>
                </div>
                
            </div>
        </div>
    <?php endif; ?>
</div>
