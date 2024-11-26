<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<?php include_once("process_create_region.php");?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="card-box p-3">
                    <div class="mb-3">
                         <h6 class="text-uppercase font-12">Ajouter une région</h6>
                    </div>
                    <div class="mb-3">
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
                </div>
                    <div class="mb-3">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="region_name" class="form-label">Nom de la région <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-none form-control-lg" id="region_name" name="region_name">
                                <?php if (isset($erreur_champ) && empty($_POST['region_name'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="btn_add_region" class="btn btn-customize text-white btn-responsive text-uppercase btn-lg">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped text-center table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Région</th>
                        <th>Ajouté le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($regions)): ?>
                        <tr>
                            <td colspan="3">Aucune région trouvée</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($regions as $index => $region): ?>
                            <tr>
                                <td><?php echo (($page - 1) * $limit) + ($index + 1); ?></td>
                                <td><?php echo htmlspecialchars($region['name']); ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($region['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
      <!-- Pagination Links -->
<div class="pagination">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link mx-1" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</div>
