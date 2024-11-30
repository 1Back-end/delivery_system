<?php 
include_once("../menu/menu.php");
include_once("../database/database.php");
include_once("../fonction/fonction.php");

if(isset($_GET["uuid"])){
    $uuid = $_GET["uuid"];
    

    // Récupérer le nom de l'entrepôt
    $stmt_warehouse = $pdo->prepare("SELECT name FROM warehouses WHERE uuid = :warehouse_uuid AND is_deleted = 0");
    $stmt_warehouse->bindParam(':warehouse_uuid', $uuid);
    $stmt_warehouse->execute();
    $warehouse = $stmt_warehouse->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si l'entrepôt existe
    if ($warehouse) {
        $warehouse_name = $warehouse['name'];
    } else {
        $warehouse_name = "Entrepôt introuvable";
    }

    // Récupérer tous les colis associés à cet entrepôt
    $stmt = $pdo->prepare("SELECT p.uuid AS package_uuid, p.package_code, p.content_description, 
        p.status, p.tracking_number, p.scheduled_delivery_date, p.delivery_date
        FROM packages p
        JOIN package_warehouse pw ON p.uuid = pw.package_uuid
        WHERE pw.warehouse_uuid = :warehouse_uuid AND pw.is_deleted = 0");
        $stmt->bindParam(':warehouse_uuid', $uuid);
        $stmt->execute();
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
?>
<div class="main-container mt-3 pb-5">
    <?php if(empty($packages)): ?>
        <div class="col-md-12 col-sm-12">
            <div class="alert alert-warning text-center" role="alert">
                Aucun colis trouvé dans l'entrepôt <?php echo $warehouse_name; ?>.
            </div>
        </div>
    <?php else: ?>
        <div class="col-md-12 col-sm-12 mb-3">
            <div class="card-box p-3">
                <h5 class="font-14 text-uppercase">Liste des colis de l'entrepôt : <?php echo htmlspecialchars($warehouse_name); ?></h5>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <!-- <th>Description</th> -->
                                <!-- <th>Numéro de suivi</th> -->
                                <th>Date de livraison estimée</th> <!-- Nouveau nom de colonne -->
                                <th>Date réelle de livraison</th> <!-- Nouveau nom de colonne -->
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $index => $package): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($package['package_code']); ?></td>
                                    <!-- <td><?php echo htmlspecialchars($package['content_description']); ?></td> -->
                                    <!-- <td><?php echo htmlspecialchars($package['tracking_number']); ?></td>
                                     -->
                                    <!-- Affichage de la Date prévue uniquement si elle est définie -->
                                    <td>
                                        <?php if(empty($package["scheduled_delivery_date"])): ?>
                                            <span class="badge badge-light">Non définie</span>
                                            <?php else: ?>
                                        <?php echo !empty($package['scheduled_delivery_date']); ?>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <!-- Affichage de la Date de livraison uniquement si elle est définie -->
                                    <td>
                                        <?php if(empty($package["delivery_date"])): ?>
                                            <span class="badge badge-light">Non définie</span>
                                            <?php else: ?>
                                        <?php echo!empty($package['delivery_date']); ?>
                                        <?php endif; ?>
                                       
                                    </td>
                                    
                                    <td>
                                       <?php if($package["status"]=='en attente'): ?>
                                        <span class="badge badge-light">En attente</span>
                                        <?php elseif($package["status"]=='livré'): ?>
                                             <span class="badge badge-success">Livré</span>
                                        <?php elseif($package["status"]=='en cours'): ?>
                                            <span class="badge badge-info">En cours</span>
                                        <?php elseif($package["status"]=='annulé'): ?>
                                            <span class="badge badge-danger">Annulé</span>
                                        <?php else: ?>
                                             <span class="badge badge-light">Inconnu</span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

Lorem ipsum d