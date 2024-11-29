<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <h5 class="text-uppercase font-14">Liste des colis (<?php echo $count_package; ?>)</h5>
        </div>
    </div>




<?php
// Récupérer les paramètres de pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Nombre de colis par page
$offset = ($page - 1) * $perPage;


// Récupérer les colis
$packages = get_all_package($pdo, $offset, $perPage);

// Récupérer le nombre total de colis
$totalQuery = "SELECT COUNT(*) FROM packages WHERE is_deleted = 0";
$totalStmt = $pdo->query($totalQuery);
$totalPackages = $totalStmt->fetchColumn();
$totalPages = ceil($totalPackages / $perPage);
?>
<?php include_once("process_add_package_in_warehouse.php");?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="mb-3">
        <div class="mb-3">
                <?php if (!empty($erreur)): ?>
                    <span class="text-danger text-center">
                        <?= htmlspecialchars($erreur); ?>
                    </span>
                <?php endif; ?>

                <!-- Message de succès -->
                <?php if (!empty($success)): ?>
                    <span class="text-success text-center">
                        <?= htmlspecialchars($success); ?>
                    </span>
                <?php endif; ?>
            </div>
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
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($packages) > 0): ?>
                        <?php foreach ($packages as $index => $package): ?>
                            <tr>
                                <td><?= ($offset + $index + 1) ?></td>
                                <td><?= $package['package_code'] ?></td>
                                <td><?= $package['package_type'] ?></td>
                                <td><?= $package['dimensions'] ?></td>
                                <td><?= $package['weight'] ?> kg</td>
                                <td>
                                <div class="d-flex align-items-center">
                                <?php if(empty($package['sender_photo'])) : ?>
                                    <!-- Affichage de l'image par défaut si l'expéditeur n'a pas de photo -->
                                    <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="User" class="rounded-circle mr-2" width="35" height="35">
                                <?php else: ?>
                                    <!-- Affichage de la photo de l'expéditeur si elle existe -->
                                    <img src="../uploads/users/<?= $package['sender_photo'] ?>" alt="User" class="rounded-circle mr-2" width="35" height="35">
                                <?php endif; ?>
                                <!-- Ajout d'un espace entre l'image et le nom -->
                                <span class="mr-3 text-truncate"><?= $package['sender_firstname'] . ' ' . $package['sender_lastname'] ?></span>
                                </div>

                                </td>

                                <td>
                                <div class="d-flex align-items-center">
                                <?php if(empty($package['receiver_photo'])) : ?>
                                    <!-- Affichage de l'image par défaut si le récepteur n'a pas de photo -->
                                    <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="User" class="rounded-circle mr-2" width="35" height="35">
                                <?php else: ?>
                                    <!-- Affichage de la photo du récepteur si elle existe -->
                                    <img src="../uploads/<?= $package['receiver_photo'] ?>" alt="User" class="rounded-circle mr-2" width="35" height="35">
                                <?php endif; ?>
                                <!-- Ajout d'un espace entre l'image et le nom -->
                                <span class="mr-3 text-truncate"><?= $package['receiver_firstname'] . ' ' . $package['receiver_lastname'] ?></span>
                            </div>


                                </td>
                                    <td>
                                    <?php if ($package['status'] == 'en attente'): ?>
                                        <span class="badge badge-warning text-center text-white disabled">En attente</span>
                                    <?php elseif ($package['status'] == 'en cours'): ?>
                                        <span class="badge badge-success text-center text-white disabled">En cours</span>
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
                                <td><?= date('d/m/Y H:i', strtotime($package['created_at'])) ?></td>

                                <td>
                                <div class="dropdown">
                                <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i> <!-- Trois points pour le menu -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Option Détails -->
                                    <li><a class="dropdown-item text-info" href="details_package.php?package_uuid=<?= $package['package_uuid'] ?>">
                                        <i class="fa fa-info-circle text-info"></i> Détails
                                    </a></li>

                                    <li><a class="dropdown-item text-danger" href="details_package.php?package_uuid=<?= $package['package_uuid'] ?>">
                                        <i class="fa fa-ban text-danger"></i> Annulée
                                    </a></li>
                                    <!-- Option Modifier -->
                                  <!-- Bouton pour ouvrir la modale -->
                                <li>
                                    <?php if($package['status'] == 'en cours') : ?>
                                        <!-- Colis déjà assigné -->
                                        <span>
                                            <a href="#" class="dropdown-item text-secondary disabled" data-toggle="modal" data-target="#assignPackageModal" data-package="<?= htmlspecialchars($package['package_uuid']); ?>">
                                                <i class="fa fa-check-circle text-secondary"></i> Déjà assigné à un entrepôt
                                            </a>
                                        </span>
                                    <?php else : ?>
                                        <!-- Colis non encore assigné -->
                                        <a href="#" class="dropdown-item text-success" data-toggle="modal" data-target="#assignPackageModal" data-package="<?= htmlspecialchars($package['package_uuid']); ?>">
                                            <i class="fa fa-share-square-o text-success"></i> Affecter à un entrepôt
                                        </a>
                                    <?php endif; ?>
                                </li>


                                    <!-- Option Supprimer -->
                                    
                                </ul>
                            </div>
                            </div>
                            </td>




                                <!-- <td>
                                    <a href="view_package.php?package_uuid=<?= $package['package_uuid'] ?>" class="btn btn-info">Voir</a>
                                    <a href="edit_package.php?package_uuid=<?= $package['package_uuid'] ?>" class="btn btn-warning">Modifier</a>
                                    <a href="delete_package.php?package_uuid=<?= $package['package_uuid'] ?>" class="btn btn-danger">Supprimer</a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="btn btn-primary">Précédent</a>
    <?php endif; ?>
    
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="btn btn-primary">Suivant</a>
    <?php endif; ?>
</div>

<div class="modal fade" id="assignPackageModal" tabindex="-1" role="dialog" aria-labelledby="assignPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignPackageModalLabel">Affecter à un entrepôt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <!-- Champ caché pour le package_uuid -->
                    <input type="hidden" name="package_uuid" class="form-control" id="modalPackageUuid" readonly>
                    <div class="form-group">    
                        <select class="form-control form-control select-custom shadow-none" name="warehouse_uuid" id="warehouse_uuid" required>
                            <option value="" disabled selected>-- Choisissez une option --</option>
                            <?php
                                foreach ($all_warehouses_active as $warehouse) {
                                    echo "<option value='{$warehouse['uuid']}'>{$warehouse['name']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="add_package_in_warehouse" class="btn btn-customize text-white btn-sm btn-xs">Affecter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ouvre la modale et remplit le champ package_uuid avec la valeur associée
        $('.dropdown-item[data-target="#assignPackageModal"]').on('click', function() {
            var package_uuid = $(this).data('package');  // Récupère le package_uuid
            $('#modalPackageUuid').val(package_uuid);  // Assigne la valeur au champ input
        });
    });
</script>