<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mr-auto">
                    <h6 class="text-uppercase font-14">Liste des chauffeurs (<?php echo $count_drivers;?>)</h6>
                </div>
                <div class="ml-auto">
                    <a href="add_driver.php" class="btn btn-customize text-white font-14 text-uppercase">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        Ajouter 
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
// Nombre d'éléments par page
$per_page = 10;

// Obtenez la page actuelle depuis les paramètres GET (par défaut la page 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Récupérer les chauffeurs de la page actuelle
$drivers = get_all_drivers($pdo, $per_page, $offset);

// Récupérer le nombre total de chauffeurs pour la pagination
$total_drivers = get_total_drivers($pdo);

// Calculer le nombre total de pages
$total_pages = ceil($total_drivers / $per_page);
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
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>N°</th>
                    <th>Nom complet</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Entrepôt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $index => $driver): ?>
                    <tr>
                        <td><?php echo ($index + 1); ?></td>
                        <td><?php echo htmlspecialchars($driver['num_drivers']); ?></td>
                        <td class="d-flex align-items-center">
                        <?php 
                        // Vérifier si la photo est vide ou non
                        if (empty($driver['photo'])) {
                            // Si la photo est vide, afficher l'image par défaut
                            $photo_path = 'https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg';
                        } else {
                            // Si la photo existe, utiliser le chemin de la photo téléchargée
                            $photo_path = "../uploads/drivers/" . htmlspecialchars($driver['photo']);
                        }
                        ?>
                        <img src="<?php echo $photo_path; ?>" alt="Photo Chauffeur" class="rounded-circle mr-2" width="35" height="35">
                        <span class="text-truncate"><?php echo htmlspecialchars($driver['firstname']) . ' ' . htmlspecialchars($driver['lastname']); ?></span>
                    </td>

                        <td><?php echo htmlspecialchars($driver['phone']); ?></td>
                        <td>
                            <?php if(empty($driver["email"])): ?>
                                example@example
                            <?php else:?>
                            <?php echo htmlspecialchars($driver['email']); ?>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if ($driver['warehouse_name']): ?>
                                <strong><?php echo htmlspecialchars($driver['warehouse_name']); ?></strong><br>
                            <?php else: ?>
                                Aucun entrepôt
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Dropdown Button -->
                        <div class="dropdown">
                            <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <!-- Trois points pour le menu -->
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Option Détails -->
                                <li><a class="dropdown-item text-info" href="details_driver.php?driver_uuid=<?php echo $driver['driver_uuid']; ?>">
                                    <i class="fa fa-info-circle text-info"></i> Détails
                                </a></li>
                                <!-- Option Modifier -->
                                <li><a class="dropdown-item text-success" href="edit.php?driver_uuid=<?php echo $driver['driver_uuid']; ?>">
                                    <i class="fa fa-pencil-square text-success"></i> Modifier
                                </a></li>
                                <!-- Option Supprimer -->
                                <li><a class="dropdown-item text-danger" href="delete_driver.php?driver_uuid=<?php echo $driver['driver_uuid']; ?>">
                                    <i class="fa fa-trash-o"></i> Supprimer
                                </a></li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1" aria-label="First">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $total_pages; ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

</div>