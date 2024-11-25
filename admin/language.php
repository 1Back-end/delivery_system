<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>
<?php include_once("lang.php");?>



<?php include_once("process_create_language.php");?>
<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <div class="card-box p-3">
                   <div class="mb-3">
                    <h6 class="text-uppercase font-14"><?= $selected_lang['add_new_language'] ?></h6>
                   </div>
                   <div class="mb-3">
                   <form action="" method="POST">
                        <div class="mb-3">
                            <label for="code"><?= $selected_lang['language_code'] ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none form-control-lg" name="code">
                                <?php if (isset($erreur_champ) && empty($_POST['code'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="name"><?= $selected_lang['language_name'] ?> <span class="text-danger"> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none form-control-lg"  name="name">
                                <?php if (isset($erreur_champ) && empty($_POST['name'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="flag_image"><?= $selected_lang['flag_url'] ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none form-control-lg"  name="flag_image">
                                <?php if (isset($erreur_champ) && empty($_POST['flag_image'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            <small id="flagHelp" class="form-text text-muted">Vous pouvez entrer l'URL de l'image du drapeau (ex. : https://path/to/flag/image.png)</small>
                        </div>
                        <div class="mb-3">
                            <!-- Message d'erreur -->
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
                        
                        <button type="submit"  class="btn btn-customize text-white text-uppercase border-0 shadow-none" name="submit"><?= htmlspecialchars($selected_lang['add_new_language']); ?></button>
                    </form>

                   </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Drapeau</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($all_languages) > 0): ?>
                        <?php foreach ($all_languages as $index => $language): ?>
                            <tr>
                                <td><?= ($index + 1) ?></td> <!-- Numéro de ligne -->
                                <td><?= htmlspecialchars($language['code']) ?></td>
                                <td><?= htmlspecialchars($language['name']) ?></td>
                                <td><img src="<?= htmlspecialchars($language['flag_image']) ?>" alt="Drapeau" width="30" height="20"></td>
                                <td>
                                    <?php if ($language['is_active'] == 1): ?>
                                        <span class="badge badge-success">Activé</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Désactivé</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($language['is_active'] == 1): ?>
                                        <!-- Bouton pour désactiver la langue -->
                                        <a href="toggle_language_status.php?uuid=<?= htmlspecialchars($language['uuid']) ?>&status=0" class="btn btn-danger btn-xs">Désactiver</a>
                                    <?php else: ?>
                                        <!-- Bouton pour activer la langue -->
                                        <a href="toggle_language_status.php?uuid=<?= htmlspecialchars($language['uuid']) ?>&status=1" class="btn btn-success btn-xs">Activer</a>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php
        // Vérifier si un message est présent dans l'URL
        $message = $_GET['message'] ?? '';
        $type = $_GET['type'] ?? '';  // 'success' ou 'error'

        // Afficher le message dans un span
        if ($message) {
            $class = ($type == 'success') ? 'text-success' : 'text-danger';
            echo '<span class="' . $class . '">' . htmlspecialchars($message) . '</span>';
        }
        ?>

    </div>
</div>
