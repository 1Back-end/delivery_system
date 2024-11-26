<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<?php include_once("process_create_neighboord.php");?>
<div class="main-container pb-5 mt-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="card-box p-3">
                    <div class="mb-3">
                        <h6 class="text-uppercase font-12">Ajouter un quartier</h6>
                    </div>
                     <!-- Messages d'erreur ou de succès -->
                     <?php if (!empty($erreur)): ?>
                        <span class="text-danger text-center">
                            <?= htmlspecialchars($erreur); ?> !
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <span class="text-success text-center">
                            <?= htmlspecialchars($success); ?> !
                        </span>
                    <?php endif; ?>
                    <div class="mb-3">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="">Ville <span class="text-danger">*</span></label>
                                <select name="ville_uuid" id="" class="form-control form-control-lg shadow-none select-custom" id="">
                                    <option value="" disabled selected>Choisir une ville</option>
                                    <?php foreach($all_city_not_deleted as $not_deleted): ?>
                                        <option value="<?php echo $not_deleted['uuid'];?>"><?php echo $not_deleted['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php if (isset($erreur_champ) && empty($_POST['ville_uuid'])): ?>
                                <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="">Nom du quartier <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['name'])): ?>
                                <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-customize text-white text-uppercase btn-responsive btn-lg">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <?php
// Nombre d'éléments par page
$perPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Récupérer les quartiers et villes avec pagination
$results = get_neighborhood_with_city($pdo, $page, $perPage);
$neighborhoods = $results['data'];
$totalCount = $results['total'];

// Calculer le nombre total de pages
$totalPages = ceil($totalCount / $perPage);
?>

<!-- Table with pagination -->
<div class="col-lg-6 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table-striped table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ville</th>
                        <th>Quartier</th>
                        <th>Ajouté le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($neighborhoods) > 0): ?>
                        <?php foreach ($neighborhoods as $index => $neighborhood): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($neighborhood['city_name']); ?></td>
                                <td><?= htmlspecialchars($neighborhood['neighborhood_name']); ?></td>
                                <td><?= htmlspecialchars($neighborhood['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($totalCount > 0): ?>
            <div class="pagination-container text-center">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        <?php endif; ?>

        </div>
    </div>
</div>
