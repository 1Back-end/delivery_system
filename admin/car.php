<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>


<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mr-auto">
                    <h5 class="text-uppercase font-14">Liste des véhicules (<?php echo $count_vehicles; ?>)</h5>
                </div>
                <div class="ml-auto">
                    <a href="add_car.php" class="btn btn-customize text-uppercase text-white">
                        <i class="fas fa-plus mr-1"></i>
                        Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
// Nombre d'éléments par page
$limit = 10;

// Calculer le numéro de page actuel (par défaut 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculer l'offset pour la requête SQL
$offset = ($page - 1) * $limit;

// Requête SQL pour obtenir le nombre total de véhicules
$total_query = "SELECT COUNT(*) FROM vehicles";
$total_stmt = $pdo->query($total_query);
$total_vehicles = $total_stmt->fetchColumn();

// Calculer le nombre total de pages
$total_pages = ceil($total_vehicles / $limit);

// Récupérer les véhicules avec les chauffeurs pour la page actuelle
$vehicles = get_car_with_drivers($pdo, $limit, $offset);
?>
   <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
    <div class="mb-3">
        <?php if(!empty($_GET["message"])) : ?>
                <?php $message = $_GET["message"]; ?>
                <span class="text-info"><?php echo $message; ?> !</span>
            <?php endif; ?>
        </div>
        <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Carburant</th>
                    <th>Capacité</th>
                    <th>Chauffeur</th>
                    <th>Statut</th>
                    <th>Crée  le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($vehicles) > 0): ?>
                    <?php foreach ($vehicles as $index => $vehicle): ?>
                        <tr>
                            <td><?php echo ($index + 1); ?></td>
                            <td><?php echo $vehicle['num_vehicles']; ?></td>
                            <td><?php echo $vehicle['fuel_type']; ?></td>
                           
                            <td><?php echo $vehicle['capacity']; ?></td>
                            <td><?php echo $vehicle['driver_firstname'] . ' ' . $vehicle['driver_lastname']; ?></td>
                            <td>
                                <?php if($vehicle["status"]=='Disponible'): ?>
                                     <span class="badge badge-success">Disponible</span>
                                <?php else:?>
                                    <span class="badge badge-danger">Occupé</span>
                                <?php endif;?>
                            </td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($vehicle['created_at'])); ?></td>

                            <td>
                            <div class="dropdown">
                            <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <!-- Trois points pour le menu -->
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Option Détails -->
                                <li><a class="dropdown-item text-info" href="details_car.php?vehicle_uuid=<?php echo $vehicle['vehicle_uuid']; ?>">
                                    <i class="fa fa-info-circle text-info"></i> Détails
                                </a></li>
                                <!-- Option Modifier -->
                                <li><a class="dropdown-item text-success" href="edit.php?vehicle_uuid=<?php echo $vehicle['vehicle_uuid']; ?>">
                                    <i class="fa fa-pencil-square text-success"></i> Modifier
                                </a></li>
                                <!-- Option Supprimer -->
                                <li><a class="dropdown-item text-danger" href="delete_car.php?vehicle_uuid=<?php echo $vehicle['vehicle_uuid']; ?>">
                                    <i class="fa fa-trash-o"></i> Supprimer
                                </a></li>
                            </ul>
                        </div>
                        </div>
                            </td>

                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Aucun enregistrement trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($vehicles)): ?>
    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>


        
    </div>
</div>

