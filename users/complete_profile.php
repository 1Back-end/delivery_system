<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));?></title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include_once("process_complete_profil.php");?>
<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
         <!-- Message d'erreur -->
         <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($erreur); ?>
            </div>
        <?php endif; ?>

        <!-- Message de succès -->
        <?php if (!empty($success)): ?>
            <div class="alert alert-success text-center">
                <?= htmlspecialchars($success); ?>
            </div>
        <?php endif; ?> 
    </div>
       
        <div class="col-md-8 col-sm-12 mb-3">
            <div class="card-box p-3 mt-3 shadow-none bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0">
                        <img src="https://i.pinimg.com/736x/ad/7a/da/ad7adab67d67f034ecbe1b7897fab4fe.jpg" 
                             class="img-fluid rounded w-100 d-none d-md-block" 
                             style="max-height: 300px; object-fit: cover;" 
                             alt="Illustration">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <h5>Finalisez la création de votre compte !</h5>
                            </div>

                            <div class="form-group mb-3">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" value="<?= htmlspecialchars($user['photo'] ?? '') ?>" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['photo'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="region">Région</label>
                                <input type="text" name="region" id="region" value="<?= htmlspecialchars($user['region'] ?? '') ?>" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['region'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" id="ville" value="<?= htmlspecialchars($user['ville'] ?? '') ?>" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['ville'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="quartier">Quartier</label>
                                <input type="text" name="quartier" id="quartier" value="<?= htmlspecialchars($user['quartier'] ?? '') ?>" class="form-control form-control-lg shadow-none">
                                <?php if (isset($erreur_champ) && empty($_POST['quartier'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" name="submit" class="btn btn-customize text-white btn-lg btn-block">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>