<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<?php include_once("process_create_car.php");?>
<div class="main-container pb-5 mt-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="mb-3">
                <h6 class="font-14 text-uppercase">Ajouté un véhicule</h6>
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
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="matricule">Matricule <span class="text-danger">*</span></label>
                                <input type="text" id="matricule" name="matricule" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['matricule'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="vehicle_type_uuid">Type Véhicule <span class="text-danger">*</span></label>
                                <select id="vehicle_type_uuid" name="vehicle_type_uuid" class="form-control form-control-lg shadow-none select-custom">
                                    <option value="" disabled selected>Choisir une option</option>
                                    <?php foreach ($vehicle_types as $vehicle_type): ?>
                                        <option value="<?= htmlspecialchars($vehicle_type); ?>"><?= htmlspecialchars($vehicle_type); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($erreur_champ) && empty($_POST['vehicle_type_uuid'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="fuel_type_uuid">Type carburant <span class="text-danger">*</span></label>
                                <select id="fuel_type_uuid" name="fuel_type_uuid" class="form-control form-control-lg shadow-none select-custom">
                                    <option value="" disabled selected>Choisir une option</option>
                                    <?php foreach ($fuels as $fuel_type): ?>
                                        <option value="<?= htmlspecialchars($fuel_type); ?>"><?= htmlspecialchars($fuel_type); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($erreur_champ) && empty($_POST['fuel_type_uuid'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="mb-3">
                                <label for="capacity">Capacité <span class="text-danger">*</span></label>
                                <input type="number" id="capacity" name="capacity" class="form-control form-control-lg shadow-none" min="1">
                                <?php if (isset($erreur_champ) && empty($_POST['capacity'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="driver_uuid">Chauffeur <span class="text-danger">*</span></label>
                                <select id="driver_uuid" name="driver_uuid" class="form-control form-control-lg shadow-none select-custom">
                                    <option value="" disabled selected>Choisir une option</option>
                                    <?php foreach ($drivers as $driver): ?>
                                        <option value="<?= htmlspecialchars($driver['uuid']); ?>">
                                            <?= htmlspecialchars($driver['firstname'] . ' ' . $driver['lastname']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($erreur_champ) && empty($_POST['driver_uuid'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control form-control-lg shadow-none" rows="5"></textarea>
                            </div>
                            <?php if (isset($erreur_champ) && empty($_POST['description'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-customize text-uppercase text-white btn-responsive btn-lg">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
