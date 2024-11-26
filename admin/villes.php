<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<?php include_once("process_create_city.php");?>
<div class="main-container mt-3 pb-3">
    <div class="row p-2">
        <!-- Formulaire d'ajout à gauche -->
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="mb-3">
                    <h6 class="font-14 text-uppercase">Ajouter une ville</h6>
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
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="pays">Région</label>
                            <select name="region_uuid" id="" class="form-control form-control-lg shadow-none select-custom">
                                <option value="" disabled selected>Choisir une région</option>
                                <?php foreach($region_for_city as $region): ?>
                                    <option value="<?php echo $region['uuid'];?>"><?php echo $region['name'];?></option>
                                <?php endforeach;?>
                            </select>
                            <?php if (isset($erreur_champ) && empty($_POST['region_uuid'])): ?>
                                <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="ville">Nom de la ville</label>
                            <input type="text" class="form-control shadow-none form-control-lg" id="ville" name="ville">
                            <?php if (isset($erreur_champ) && empty($_POST['ville'])): ?>
                                <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="btn_add_city" class="btn btn-customize text-white btn-responsive text-uppercase btn-lg">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tableau des villes à droite -->
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="card-box p-3">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Région</th>
                                <th>Ville</th>
                                <th>Ajouté le</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Définir la limite de résultats par page
                            $limit = 5;

                            // Calculer le nombre total de pages
                            $total_cities = get_total_city_count($pdo);
                            $total_pages = ceil($total_cities / $limit);

                            // Récupérer le numéro de la page actuelle
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($page - 1) * $limit;

                            // Récupérer les villes pour la page actuelle
                            $cities = get_city_with_region($pdo, $limit, $offset);

                            if (!empty($cities)): // Vérifier s'il y a des villes
                                foreach ($cities as $index => $city): ?>
                                    <tr>
                                        <td><?php echo $index + 1 + ($page - 1) * $limit; ?></td>
                                        <td><?php echo htmlspecialchars($city['region_name']); ?></td>
                                        <td><?php echo htmlspecialchars($city['city_name']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($city['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">Aucune donnée disponible</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if (!empty($cities)): // Afficher la pagination seulement si des villes existent ?>
                    <div class="pagination">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link mx-1" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
