<?php include("menu.php"); ?>
<?php include("fonction.php"); ?>


<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mr-auto">
                    <h6 class="text-uppercase font-14">Mes colis (<?php echo $count_packages_users_uuid;?>)</h6>
                </div>
                <div class="ml-auto">
                    <a href="add_package.php" class="btn btn-customize text-white border-0 shadow-none text-uppercase">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
// Récupérer l'UUID de l'utilisateur et la page courante (par défaut page 1)
$user_uuid = $_SESSION["uuid"]; // Remplacez par l'UUID réel de l'utilisateur
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Nombre de colis par page

// Récupérer les colis de l'utilisateur
$packages = get_all_packages_users_uuid($pdo, $user_uuid, $page, $perPage);

// Calculer le nombre total de pages
$totalQuery = "SELECT COUNT(*) FROM packages WHERE sender_uuid = :user_uuid AND is_deleted = 0";
$stmt = $pdo->prepare($totalQuery);
$stmt->bindValue(':user_uuid', $user_uuid, PDO::PARAM_STR);
$stmt->execute();
$totalItems = $stmt->fetchColumn();
$totalPages = ceil($totalItems / $perPage);
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
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Dimension</th>
                        <th>Poids</th>
                        <th>Destinataire</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $index => $package): ?>
                    <tr>
                        <td><?= ($page - 1) * $perPage + ($index + 1) ?></td>
                        <!--  -->
                        <td><?= $package['package_code'] ?></td>

                        <td><?= htmlspecialchars($package['package_type']) ?></td>
                        <td><?= htmlspecialchars($package['dimensions']) ?></td>
                        <td><?= htmlspecialchars($package['weight']) ?> kg</td>
                        <td>
                            <?= htmlspecialchars($package['sender_firstname']) . ' ' . htmlspecialchars($package['sender_lastname']) ?>
                        </td>
                        <td>
                            <?php if ($package['status'] == 'en attente'): ?>
                                <span class="badge badge-warning text-center text-white disabled">En attente</span>
                            <?php elseif ($package['status'] == 'en transit'): ?>
                                <span class="badge badge-success text-center text-white disabled">Expédié</span>
                            <?php elseif ($package['status'] == 'livré'): ?>
                                <span class="badge badge-danger text-center text-white disabled">Livré</span>
                            <?php elseif ($package['status'] == 'annulé'): ?>
                                <span class="badge badge-secondary text-center text-white disabled">Annulé</span>
                            <?php elseif ($package['status'] == 'perdu'): ?>
                                <span class="badge badge-dark text-center text-white disabled">Perdu</span>
                            <?php else: ?>
                                <span class="badge badge-info text-center text-white disabled">Inconnu</span>
                            <?php endif; ?>
                        </td>
                        </td>
                        <td><?= date('d/m/Y H:i:s', strtotime($package['created_at'])) ?></td>
                        <td>
                            <div class="dropdown">
                            <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i> <!-- Trois points pour le menu -->
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Option Détails -->
                                <li><a class="dropdown-item text-info" href="details_package.php?package_uuid=<?php echo $package['package_uuid']; ?>">
                                    <i class="fa fa-info-circle text-info"></i> Détails
                                </a></li>
                                <!-- Option Modifier -->
                                <li><a class="dropdown-item text-success" href="edit.php?package_uuid=<?php echo $package['package_uuid']; ?>">
                                    <i class="fa fa-pencil-square text-success"></i> Modifier
                                </a></li>
                                <!-- Option Supprimer -->
                                <li><a class="dropdown-item text-danger" href="delete_car.php?package_uuid=<?php echo $package['package_uuid']; ?>">
                                    <i class="fa fa-trash-o"></i> Supprimer
                                </a></li>
                            </ul>
                        </div>
                        </div>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary">Précédent</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary">Suivant</a>
    <?php endif; ?>
</div>
