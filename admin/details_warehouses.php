<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<link rel="stylesheet" href="style.css">

<?php

if (isset($_GET["uuid"])) {
    $uuid_warehouse = $_GET["uuid"] ?? null;

    // Requête avec jointure pour récupérer les informations de l'entrepôt et l'utilisateur (firstname, lastname)
    $query = "
        SELECT w.*, u.firstname, u.lastname 
        FROM warehouses w
        LEFT JOIN users u ON w.added_by = u.uuid 
        WHERE w.uuid = :uuid_warehouse
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":uuid_warehouse", $uuid_warehouse);
    $stmt->execute();
    $result = $stmt->fetch();

    // Code additionnel ici...
}

function format_date($date) {
    // Vérifier si la date est valide
    if ($date) {
        return date("d/m/Y H:i", strtotime($date));  // Formater la date en jour/mois/année heure:minute
    }
    return null;  // Si la date n'est pas valide, retourner null
}
?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
             <h6 class="font-14 text-uppercase">Détails de l'entrepôt N° <?php echo htmlspecialchars($result['num_warehouses']); ?></h6>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">
            <div class="col-lg-4 text-center col-sm-12 mb-3">
                <div class="card-box p-3">
                    <div class="mb-3">
                        <h6 class="text-uppercase font-14">Logo de l'entrepôt</h6>
                    </div>
                <?php if(empty($result['logo'])): ?>
                        <img src="https://i.pinimg.com/736x/25/30/71/253071375e1b3015762a9d9c94c01453.jpg" class="img-fluid logo_entrepot" >
                    <?php else: ?>
                        <img src="../uploads/<?= htmlspecialchars($result['logo'])?>" alt="" class="img-fluid logo_entrepot" alt="Logo">
                <?php endif;?>

                </div>
            </div>
            <div class="col-lg-8 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="mb-3">
            <h6 class="text-uppercase font-14 text-center">Informations générales</h6>
        </div>
        <div class="row">
            <!-- Colonne gauche -->
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="font-12 mb-4">Nom de l'entrepôt : <?php echo htmlspecialchars($result['name']); ?></h6>
                    <h6 class="font-12 mb-4">Adresse : <?php echo htmlspecialchars($result['address']); ?></h6>
                    <h6 class="font-12 mb-4">Contact : <?php echo htmlspecialchars($result['phone']); ?></h6>
                    <h6 class="font-12 mb-4">Créé le : <?php echo format_date($result['created_at']); ?></h6>
                  
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="col-md-6">
                <div class="mb-3">
                    <h6 class="font-12 mb-4">Dernière modification : <?php echo format_date($result['updated_at']); ?></h6>
                    <h6 class="font-12 mb-4">Email : <?php echo htmlspecialchars($result['email']); ?></h6>
                    <h6 class="font-12 mb-4">Statut : 
                        <?php if($result['status'] == 'active'): ?>
                            <span class="badge badge-success">Actif</span>
                        <?php elseif($result['status'] == 'inactive'):?>
                            <span class="badge badge-danger">Inactif</span>
                        <?php endif;?>
                    </h6>
                    <h6 class="font-12 mb-4">Ajouté par : <?php echo htmlspecialchars($result['firstname']).' '.htmlspecialchars($result['lastname']);?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
