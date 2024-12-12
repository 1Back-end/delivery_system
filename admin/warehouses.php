<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
       <div class="card-box p-3">
       <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
                <?php $warehouses = get_total_warehouses($pdo);?>
                <h6 class="text-uppercase font-14">Liste des entrepôts (<?php echo $warehouses;?>)</h6>
            </div>
            <div class="ml-auto">
                <a href="add_warehouses.php" class="btn btn-customize text-white font-14 text-uppercase">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                    Ajouter 
                </a>
            </div>
        </div>
       </div>
    </div>

<?php
// Définir le nombre d'entrepôts par page
$limit = 10;

// Récupérer la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Récupérer les entrepôts
$all_warehouses = get_all_warehouses($pdo, $limit, $offset);

// Récupérer le nombre total d'entrepôts
$total_warehouses = get_warehouses_count($pdo);

// Calculer le nombre total de pages
$total_pages = ceil($total_warehouses / $limit);
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="mb-3">
            <?php if(!empty($_GET["msg"])) : ?>
                <?php $msg = $_GET["msg"]; ?>
                <span class="text-info"><?php echo $msg; ?> !</span>
            <?php endif; ?>

            <?php if(!empty($_GET["message"])) : ?>
                <?php $message = $_GET["message"]; ?>
                <span class="text-info"><?php echo $message; ?> !</span>
            <?php endif; ?>

            <?php if(!empty($_GET["info"])) : ?>
                <?php $info = $_GET["info"]; ?>
                <span class="text-info"><?php echo $info; ?> !</span>
            <?php endif; ?>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N°</th>
                        <th>Logo</th>
                        <th>Entrepôt</th>
                        <th>Adresse</th>
                        <th>Ajouté le</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($all_warehouses)): ?>
                        <tr><td colspan="10">Aucun élément trouvé</td></tr>
                    <?php else: ?>
                        <?php foreach ($all_warehouses as $index => $warehouse): ?>
                            <tr>
                                <td><?php echo ($index + 1); ?></td>
                                <td><?= htmlspecialchars($warehouse['num_warehouses'])?></td>

                                <td>
                                    <?php if(empty($warehouse['logo'])): ?>
                                        <img src="https://i.pinimg.com/736x/25/30/71/253071375e1b3015762a9d9c94c01453.jpg" class="img-fluid rounded-circle" alt="Logo" width='50' height='50' style='object-fit: cover;'>
                                    <?php else: ?>
                                        <img src="../uploads/<?= htmlspecialchars($warehouse['logo'])?>" alt="" class="img-fluid rounded-circle" alt="Logo" width='50' height='50' style='object-fit: cover;'>
                                    <?php endif;?>
                                </td>

                                <td><?= htmlspecialchars($warehouse['name']) ?></td>
                                <td><?= htmlspecialchars($warehouse['address']) ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($warehouse['created_at'])) ?></td>
                                <td>
                                    <?php if($warehouse['status'] == 'active'): ?>
                                        <span class="badge badge-success">Actif</span>
                                    <?php else:?>
                                        <span class="badge badge-danger">Inactif</span>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item text-info" href="details_warehouses.php?uuid=<?= $warehouse['uuid']; ?>">
                                                    <span class="fa fa-info-circle text-info"></span> Détails
                                                </a>
                                            </li>
                                            <!-- Si le statut est 'inactive', la liaison pour voir les colis sera désactivée -->
                                                <li>
                                                    <?php if ($warehouse["status"] == 'inactive') : ?>
                                                        <a class="dropdown-item text-muted" href="#" onclick="return false;">
                                                            <span class="fa fa-cube text-muted"></span> Voir les colis
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item text-success text-white" href="view_packages.php?uuid=<?= $warehouse['uuid']; ?>">
                                                            <span class="fa fa-cube text-success text-white"></span> Voir les colis
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                <a class="dropdown-item text-danger" href="delete_warehouses.php?uuid=<?= $warehouse['uuid']; ?>">
                                                    <span class="fa fa-trash-o text-danger"></span> Supprimer
                                                </a>
                                            </li>
                                            <?php if ($warehouse['status'] == 'active'): ?>
                                                <li>
                                                    <a class="dropdown-item text-warning" href="deactivate_warehouses.php?uuid=<?= $warehouse['uuid']; ?>">
                                                        <span class="fa fa-toggle-on text-warning"></span> Désactiver
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a class="dropdown-item text-success" href="activate_warehouses.php?uuid=<?= $warehouse['uuid']; ?>">
                                                        <span class="fa fa-check-circle text-success"></span> Activer
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($all_warehouses)): ?>
         <!-- Pagination -->
         <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=1" aria-label="Première page">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Précédent">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= ($page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Suivant">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item <?= ($page == $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $total_pages; ?>" aria-label="Dernière page">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif;?>
    </div>
</div>
