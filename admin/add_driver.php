<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>




<?php include_once("process_create_drivers.php");?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="mb-3">
                <h6 class="font-14 text-uppercase">Ajouter un chauffeur</h6>
            </div>
            <div class="mb-3">
                <!-- Messages d'erreur ou de succès -->
                <?php if (!empty($erreur)): ?>
                    <span class="text-danger text-center">
                        <?= htmlspecialchars($erreur); ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <span class="text-success text-center">
                        <?= htmlspecialchars($success); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Colonne gauche -->
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="warehouse_uuid" class="form-label">
                                    Entrepôt <span class="text-danger">*</span>
                                </label>
                                <select id="warehouse_uuid" name="warehouse_uuid" class="form-control form-control-lg shadow-none select-custom">
                                    <option value="" disabled selected>-- Sélectionnez un entrepôt --</option>
                                    <?php foreach($all_warehouses_active as $warehouse): ?>
                                        <option value="<?= htmlspecialchars($warehouse['uuid']); ?>">
                                            <?= htmlspecialchars($warehouse['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($erreur_champ) && empty($_POST['warehouse_uuid'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>

                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" id="firstname" name="firstname" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['firstname'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['lastname'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['phone'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg shadow-none">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control form-control-lg shadow-none">
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'envoi -->
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-customize btn-responsive text-white">
                            Ajouter le chauffeur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
