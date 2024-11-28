<?php include("menu.php"); ?>
<?php include("fonction.php"); ?>


<?php include("process_create_package.php"); ?>
<div class="main-container mt-3 pb-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
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
                    
                <div class="col-lg-6 col-sm-12 mb-3">
                        <div class="mb-3">
                            <h5 class="text-uppercase font-14">Informations du destinataire</h5>
                        </div>
                        <!-- Nom -->
                        <div class="mb-3">
                        <label for="last_name">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" id="last_name" 
                            class="form-control shadow-none form-control-lg" 
                            placeholder="Entrez le nom du destinataire" 
                            value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"> <!-- Conservation de la valeur -->
                        <?php if (isset($erreur_champ) && empty($_POST['last_name'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                        <!-- Prénom -->
                        <!-- Champ Prénom -->
                    <div class="mb-3">
                        <label for="first_name">Prénom <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="first_name" 
                            class="form-control shadow-none form-control-lg" 
                            placeholder="Entrez le prénom du destinataire"
                            value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"> <!-- Conservation de la valeur -->
                        <?php if (isset($erreur_champ) && empty($_POST['first_name'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Champ Numéro de téléphone -->
                    <div class="mb-3">
                        <label for="phone_number">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_number" id="phone_number" 
                            class="form-control shadow-none form-control-lg" 
                            placeholder="Ex: +237 6XX XXX XXX" 
                            pattern="^\+?\d{1,4}?[-.\s]?\(?\d{1,4}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,9}$"
                            value="<?= htmlspecialchars($_POST['phone_number'] ?? '') ?>"> <!-- Conservation de la valeur -->
                        <?php if (isset($erreur_champ) && empty($_POST['phone_number'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" 
                                class="form-control shadow-none form-control-lg" 
                                placeholder="Ex: exemple@mail.com"
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"> <!-- Conservation de la valeur -->
                                <?php if (isset($erreur_champ) && empty($_POST['email'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                        </div>

                        <!-- Région -->
                        <div class="mb-3">
                            <label for="region">Région <span class="text-danger">*</span></label>
                            <select name="region_uuid" id="region" 
                                    class="form-control shadow-none form-control-lg select-custom">
                                <option value="" disabled <?= empty($_POST['region_uuid']) ? 'selected' : '' ?>>Choisir une région</option>
                                <?php foreach ($regions as $region): ?>
                                    <option value="<?= htmlspecialchars($region['uuid']); ?>" 
                                        <?= (isset($_POST['region_uuid']) && $_POST['region_uuid'] === $region['uuid']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($region['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($erreur_champ) && empty($_POST['region_uuid'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label for="city">Ville <span class="text-danger">*</span></label>
                            <select name="city_uuid" id="city" 
                                    class="form-control form-control-lg shadow-none select-custom">
                                <option value="" disabled <?= empty($_POST['city_uuid']) ? 'selected' : '' ?>>Choisir une option</option>
                                <?php if (!empty($cities)): ?> <!-- Si vous avez des villes chargées -->
                                    <?php foreach ($cities as $city): ?>
                                        <option value="<?= htmlspecialchars($city['uuid']); ?>" 
                                            <?= (isset($_POST['city_uuid']) && $_POST['city_uuid'] === $city['uuid']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($city['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if (isset($erreur_champ) && empty($_POST['city_uuid'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                        </div>

                        <!-- Quartier -->
                        <div class="mb-3">
                            <label for="neighborhood">Quartier <span class="text-danger">*</span></label>
                            <select name="neighborhood_uuid" id="neighborhood" 
                                    class="form-control form-control-lg shadow-none select-custom">
                                <option value="" disabled <?= empty($_POST['neighborhood_uuid']) ? 'selected' : '' ?>>Choisir une option</option>
                                <?php if (!empty($neighborhoods)): ?> <!-- Si vous avez des quartiers chargés -->
                                    <?php foreach ($neighborhoods as $neighborhood): ?>
                                        <option value="<?= htmlspecialchars($neighborhood['uuid']); ?>" 
                                            <?= (isset($_POST['neighborhood_uuid']) && $_POST['neighborhood_uuid'] === $neighborhood['uuid']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($neighborhood['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if (isset($erreur_champ) && empty($_POST['neighborhood_uuid'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                        </div>
                        </div>
                        
                        <div class="col-lg-6 col-sm-12 mb-3">
                        <div class="mb-3">
                        <h5 class="text-uppercase font-14">Informations du colis</h5>
                        </div>
                        <!-- Type de colis -->
                        <div class="mb-3">
                            <label for="package_type">Type de colis <span class="text-danger">*</span></label>
                            <select name="package_type" id="package_type" 
                                    class="form-control form-control-lg shadow-none select-custom">
                                <option value="" disabled <?= empty($_POST['package_type']) ? 'selected' : '' ?>>Choisir le type de colis</option>
                                <?php foreach ($packageTypes as $packageType): ?>
                                    <option value="<?= htmlspecialchars($packageType); ?>" 
                                        <?= (isset($_POST['package_type']) && $_POST['package_type'] === $packageType) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($packageType); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($erreur_champ) && empty($_POST['package_type'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                        </div>


                        <div class="mb-3">
                        <label for="package_image">Photo du colis <span class="text-danger">*</span></label>
                        <!-- Cadre de prévisualisation -->
                        <div class="border p-3 rounded d-flex flex-column align-items-center justify-content-center" 
                            style="height: 100px; border-style: dashed; cursor: pointer;" 
                            id="imagePreviewContainer">
                            <img id="imagePreview" src="#" alt="Aperçu de la photo" 
                                style="width: 100%; height: 100%; object-fit: cover; display: none;" />
                            <span id="imagePlaceholder" style="color: #ccc; font-size: 14px;">Cliquez pour sélectionner une photo</span>
                        </div>
                        <!-- Champ caché pour sélectionner le fichier -->
                        <input type="file" name="package_image" id="package_image" 
                            class="d-none" accept="image/*">
                        <small class="form-text text-muted">Téléchargez une photo claire du colis (max : 2 Mo).</small>
                        <?php if (isset($erreur_champ) && empty($_POST['package_image'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>



                        <div class="mb-3">
                        <label for="weight">Poids (kg) <span class="text-danger">*</span></label>
                        <input type="number" name="weight" id="weight" 
                            class="form-control shadow-none form-control-lg" 
                            step="0.1" 
                            placeholder="Exemple : 2.5" 
                            value="<?= htmlspecialchars($_POST['weight'] ?? '') ?>"> <!-- Conservation de la valeur -->
                        <small class="form-text text-muted">Veuillez entrer le poids en kilogrammes (max : 30 kg).</small>
                        <?php if (isset($erreur_champ) && empty($_POST['weight'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="dimensions">Dimensions (L × l × h) en cm <span class="text-danger">*</span></label>
                        <select name="dimensions" id="dimensions" 
                                class="form-control form-control-lg shadow-none select-custom">
                            <option value="" disabled <?= empty($_POST['dimensions']) ? 'selected' : '' ?>>Choisir le type de colis</option>
                            <?php foreach ($packageDimensions as $packageDimension): ?>
                                <option value="<?= htmlspecialchars($packageDimension); ?>" 
                                    <?= (isset($_POST['dimensions']) && $_POST['dimensions'] === $packageDimension) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($packageDimension); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($erreur_champ) && empty($_POST['dimensions'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="declared_value">Valeur déclarée (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" name="declared_value" id="declared_value" 
                            class="form-control shadow-none form-control-lg" 
                            placeholder="Exemple : 50000" 
                            value="<?= htmlspecialchars($_POST['declared_value'] ?? '') ?>"> <!-- Conservation de la valeur -->
                        <?php if (isset($erreur_champ) && empty($_POST['declared_value'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="content_description">Description du contenu <span class="text-danger">*</span></label>
                        <textarea name="content_description" id="content_description" 
                                rows="4" 
                                class="form-control shadow-none form-control-lg" 
                                placeholder="Décrivez brièvement le contenu du colis"><?= htmlspecialchars($_POST['content_description'] ?? '') ?></textarea> <!-- Conservation de la valeur -->
                        <?php if (isset($erreur_champ) && empty($_POST['content_description'])): ?>
                            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                        <?php endif; ?>
                    </div>   
                </div>
                </div>
                <div class="mb-3">
                    <button type="submit" name="btn_add_packages" class="btn btn-customize text-white btn-responsive btn-lg shadow-none">Envoyer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Référence aux éléments
    const imageContainer = document.getElementById('imagePreviewContainer');
    const fileInput = document.getElementById('package_image');
    const imagePreview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imagePlaceholder');

    // Ouvrir le champ de sélection de fichier au clic sur le cadre
    imageContainer.addEventListener('click', () => {
        fileInput.click();
    });

    // Afficher l'aperçu de l'image une fois sélectionnée
    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                placeholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    });
</script>
<script>
$(document).ready(function() {
    // Charger les villes lorsque la région change
    $('#region').change(function() {
        const region_uuid = $(this).val();
        if (region_uuid) {
            $.ajax({
                url: 'fetch_cities.php',
                method: 'GET',
                data: { region_uuid: region_uuid },
                dataType: 'json',
                success: function(data) {
                    $('#city').empty().append('<option value="" disabled selected>Choisir une option</option>');
                    data.forEach(city => {
                        $('#city').append(`<option value="${city.uuid}">${city.name}</option>`);
                    });
                    $('#city').prop('disabled', false);
                    $('#neighborhood').empty().append('<option value="" disabled selected>Choisir une ville</option>').prop('disabled', true);
                }
            });
        }
    });

    // Charger les quartiers lorsque la ville change
    $('#city').change(function() {
        const city_uuid = $(this).val();
        if (city_uuid) {
            $.ajax({
                url: 'fetch_neighborhoods.php',
                method: 'GET',
                data: { city_uuid: city_uuid },
                dataType: 'json',
                success: function(data) {
                    $('#neighborhood').empty().append('<option value="" disabled selected>Choisir une option</option>');
                    data.forEach(neighborhood => {
                        $('#neighborhood').append(`<option value="${neighborhood.uuid}">${neighborhood.name}</option>`);
                    });
                    $('#neighborhood').prop('disabled', false);
                }
            });
        }
    });
});
</script>
