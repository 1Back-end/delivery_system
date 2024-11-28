<?php include("menu.php"); ?>
<?php include("fonction.php"); ?>

<?php
// Assurez-vous que la variable $package_uuid est bien définie
if (isset($_GET["package_uuid"])) {
    $package_uuid = $_GET["package_uuid"];
    
    // Connexion à la base de données

    // Préparation de la requête
    $query = "
        SELECT 
            p.uuid AS package_uuid,
            p.package_code,
            p.package_type,
            p.dimensions,
            p.weight,
            p.package_code,
            p.status,
            p.package_image,
            p.price,
            p.package_image,
            p.declared_value,
            p.scheduled_delivery_date,
            p.created_at,
            u.firstname AS sender_firstname,
            u.lastname AS sender_lastname,
            u.email AS sender_email,
            u.phone_number AS sender_contact,
            r.name AS region_name,
            c.name AS city_name,
            n.name AS neighborhood_name,
            ur.firstname AS receiver_firstname,
            ur.lastname AS receiver_lastname,
            ur.email AS receiver_email,
            ur.phone_number AS receiver_contact
        FROM packages p
        JOIN users u ON p.sender_uuid = u.uuid
        JOIN regions r ON p.region_uuid = r.uuid
        JOIN cities c ON p.city_uuid = c.uuid
        JOIN neighborhoods n ON p.neighborhoods_uuid = n.uuid
        JOIN users ur ON p.receiver_uuid = ur.uuid  -- Jointure pour le destinataire
        WHERE p.is_deleted = 0
        AND p.uuid = :package_uuid;
    ";

    // Exécution de la requête
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':package_uuid', $package_uuid);
    $stmt->execute();

    
    // Récupération des résultats
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="main-container mt-3 pb-3">
    <div class="col-md-8 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="mb-3">
                <h5 class="text-uppercase font-14 text-center">Détails du colis N° <?php echo $package['package_code'];?></h5>
            </div>

            <div class="mb-3 mt-3">
                <div class="row">
                    <!-- Informations du destinataire -->
                    <div class="col-lg-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <h5 class="text-uppercase font-14">Informations du destinataire</h5>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Nom Complet : </strong><?php echo $package['receiver_firstname'] .' '. $package['receiver_lastname']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Email : </strong><?php echo $package['receiver_email']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Téléphone : </strong><?php echo $package['receiver_contact']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Région : </strong><?php echo $package['region_name']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Ville : </strong><?php echo $package['city_name']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Quartier : </strong><?php echo $package['neighborhood_name']; ?></p>
                        </div>
                    </div>

                    <!-- Informations du colis -->
                    <div class="col-lg-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <h5 class="text-uppercase font-14">Informations du colis</h5>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Type de colis : </strong><?php echo $package['package_type']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Dimensions : </strong><?php echo $package['dimensions']; ?> m³</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Poids : </strong><?php echo $package['weight']; ?> kg</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Etat : </strong><?php echo $package['status']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Code de suivi : </strong><?php echo $package['package_code']; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-uppercase font-14"><strong>Prix à payer : </strong><?php echo $package['price']; ?> FCFA</p>
                        </div>
                        <div class="mb-3">
                        <p class="text-uppercase font-14"><strong>Valeur : </strong><?php echo $package['declared_value']; ?> FCFA</p>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <!-- Section image du colis -->
        <div class="mr-auto">
            <h6 class="text-uppercase font-14">Image du colis</h6>
            <div class="mb-3">
                <?php if (!empty($package['package_image'])): ?>
                    <?php 
                    $imagePath = "../uploads/packages/" . htmlspecialchars($package['package_image']);
                    if (file_exists($imagePath)): 
                    ?>
                        <img src="<?= $imagePath ?>" alt="Image du colis" style="max-width: 100px; max-height: 100px;">
                    <?php else: ?>
                        <span>L'image n'existe pas à l'emplacement <?= $imagePath ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <span>Aucune image disponible</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Section notification du destinataire -->
        <div class="ml-auto">
            <a href="notification.php?package_uuid=<?php echo $package['package_uuid']; ?>" class="btn btn-success btn-sm">
                <i class="fa fa-bell" aria-hidden="true"></i>
                Notifié le destinataire
            </a>
        </div>
    </div>
</div>
