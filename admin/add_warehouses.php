<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>

<?php include_once("process_create_warehouses.php");?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="mb-3">
                <h6 class="font-14 text-uppercase">Ajouter un entrepôt</h6>
            </div>
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
            <div class="mb-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de l'entrepôt<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['name'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Adresse<span class="text-danger">*</span></label>
                                <input type="text" id="address" name="address" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['address'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacité (nombre de colis ou volume)<span class="text-danger">*</span></label>
                                <input type="number" id="capacity" name="capacity" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['capacity'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Numéro de téléphone</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['phone'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['email'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" id="logo" name="logo" class="form-control form-control-lg form-control-file shadow-none" accept="image/*">
                                
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-customize btn-responsive text-white">Créer l'entrepôt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
