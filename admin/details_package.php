<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<?php
if (isset($_GET["package_uuid"])) {
    $package_uuid = $_GET["package_uuid"];

    // Préparez la requête pour récupérer les détails du colis
    $query = "
    SELECT 
        p.uuid AS package_uuid,
        p.package_code,
        p.package_type,
        p.dimensions,
        p.weight,
        p.status,
        p.package_image,
        p.price,
        p.declared_value,
        p.tracking_number,
        p.qr_code as qr_code_image,
        p.scheduled_delivery_date,
        p.created_at,
        u1.firstname AS sender_firstname,
        u1.lastname AS sender_lastname,
        u1.email AS sender_email,
        u1.phone_number AS sender_contact,
        u1.photo AS sender_photo,
        u1.region as sender_region,
        u1.ville as sender_city ,
        u1.quartier as sender_quartier,
        u2.firstname AS receiver_firstname,
        u2.lastname AS receiver_lastname,
        u2.email AS receiver_email,
        u2.phone_number AS receiver_contact,
        u2.photo AS receiver_photo,
        r.name AS receiver_region_name,  -- Nom de la région du récepteur
        c.name AS receiver_city_name,    -- Nom de la ville du récepteur
        n.name AS receiver_neighborhood_name -- Nom du quartier du récepteur
    FROM 
        packages p
    JOIN 
        users u1 ON p.sender_uuid = u1.uuid
    JOIN 
        users u2 ON p.receiver_uuid = u2.uuid
    LEFT JOIN 
        regions r ON p.region_uuid = r.uuid  -- Jointure avec la table regions pour le récepteur
    LEFT JOIN 
        cities c ON p.city_uuid = c.uuid    -- Jointure avec la table cities pour le récepteur
    LEFT JOIN 
        neighborhoods n ON p.neighborhoods_uuid = n.uuid -- Jointure avec la table neighborhoods pour le récepteur
    WHERE 
        p.is_deleted = 0 AND p.uuid = :package_uuid
";



    // Utilisation de PDO pour exécuter la requête
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':package_uuid', $package_uuid, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer les données
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
    

}
?>

<div class="main-container mt-3 pb-5"> 
   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mb-3">
                <div class="mb-2">
                    <h5 class="font-14 text-uppercase">informations de l'expediteur</h5>
                </div>
                <div class="mb-2">
                    <p class="text-capitalize font-14 mb-2"><strong>Nom Complet : </strong><?php echo $package['sender_firstname'] .' '. $package['sender_lastname']; ?></p>
                    <p class="font-14 mb-2"><strong>Email : </strong><?php echo $package['sender_email'];?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Téléphone : </strong>
                    <?php if(empty($package['sender_contact'])): ?>
                        <span>Non renseigné</span>
                    <?php else:?>
                        <span><?php echo $package['sender_contact'];?></span>
                    </p>
                    <?php endif;?>
                    <p class="text-capitalize font-14 mb-2"><strong>Région : </strong><?php echo $package['sender_region'];?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Ville : </strong><?php echo $package['sender_city'];?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Quartier : </strong><?php echo $package['sender_quartier'];?></p>
                    
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mb-3">
                <div class="mb-2">
                    <h5 class="font-14 text-uppercase">informations du Destinataire</h5>
                </div>
                <div class="mb-3">
                    <p class="text-capitalize font-14 mb-2"><strong>Nom Complet : </strong><?php echo $package['receiver_firstname'] .' '. $package['receiver_lastname']; ?></p> 
                    <p class="font-14 mb-2"><strong>Email : </strong><?php echo $package['receiver_email'];?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Téléphone : </strong><?php echo $package['receiver_contact'];?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Région : </strong><?php echo $package['receiver_region_name']; ?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Ville : </strong><?php echo $package['receiver_city_name']; ?></p>
                    <p class="text-capitalize font-14 mb-2"><strong>Quartier : </strong><?php echo $package['receiver_neighborhood_name']; ?></p>
                
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mb-3">
            <h5 class="font-14 text-uppercase">informations du colis</h5>
            <div class="mb-3">
               <p class="text-capitalize font-14 mb-2"><strong>Code : </strong><?php echo $package['package_code']; ?></p>
                <p class="text-capitalize font-14 mb-2"><strong>Type: </strong><?php echo $package['package_type']; ?></p>
                <p class="text-capitalize font-14 mb-2"><strong>Dimensions : </strong><?php echo $package['dimensions']; ?></p>     
                <p class="text-capitalize font-14 mb-2"><strong>Poids : </strong><?php echo $package['weight']; ?> kg</p>
                <p class="text-capitalize font-14 mb-2"><strong>Numéro de suivi : </strong><?php echo $package['tracking_number']; ?></p>
                <p class="text-capitalize font-14 mb-2"><strong>Valeur : </strong><?php echo $package['declared_value']; ?> FCFA</p>
                </div>
            </div>

   

            <div class="col-lg-12 col-sm-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
                    <?php if (isset($package['package_image'])): ?>
                        <a href="../uploads/packages/<?= $package['package_image'] ?>" class="btn btn-customize mb-3 btn-sm text-white btn-lg btn-responsive" download>
                            <i class="fa fa-download mr-2"></i> Télécharger l'image du colis
                        </a>
                    <?php else: ?>
                        <span class="text-muted">Aucune image disponible</span>
                    <?php endif; ?>
                    <?php if (isset($package['qr_code_image'])): ?>
                        <a href="javascript:void(0);" class="btn btn-customize btn-sm text-white btn-lg mb-3 btn-responsive" onclick="printQRCode('../uploads/qrcodes_colis/<?= $package['qr_code_image'] ?>')">
                            <i class="fa fa-qrcode mr-2"></i> Imprimer le QR code
                        </a>
                    <?php else: ?>
                        <span class="text-muted">QR code non disponible</span>
                    <?php endif; ?>
               
            </div>
        </div>


            </div>
         
        </div>
    </div>
   </div>
</div>


<script>
    function printQRCode(qrCodeUrl) {
        var printWindow = window.open(qrCodeUrl, '_blank');
        printWindow.print();
    }
</script>
