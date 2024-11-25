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


<div class="container mt-5 pb-5 p-2">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12 mb-3">
            
    <?php include_once("process_create_users.php"); ?>
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

        <div class="col-md-8 col-sm-12">
            <div class="card-box p-3 mt-3 shadow-none bg-white">
                <div class="row align-items-center">
                    <!-- Image Section -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3 mb-lg-0">
                        <img src="https://i.pinimg.com/736x/ad/7a/da/ad7adab67d67f034ecbe1b7897fab4fe.jpg" 
                             class="img-fluid rounded w-100 d-none d-md-block" 
                             style="max-height: 300px; object-fit: cover;" 
                             alt="Illustration">
                    </div>

                    <!-- Form Section -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="" method="post">
                            <div class="mb-3">
                                <h5>Créer votre compte !</h5>
                            </div>

                            <!-- First Name Input -->
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Nom</label>
                                <input type="text" name="firstname" class="form-control form-control-lg shadow-none" placeholder="John">
                                <?php if (isset($erreur_champ) && empty($_POST['firstname'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- Last Name Input -->
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Prénom</label>
                                <input type="text" name="lastname" class="form-control form-control-lg shadow-none" placeholder="Doe">
                                <?php if (isset($erreur_champ) && empty($_POST['lastname'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" name="email" class="form-control form-control-lg shadow-none" placeholder="john.doe@example.com">
                                <?php if (isset($erreur_champ) && empty($_POST['email'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- Phone Number Input -->
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                <input type="tel" name="phone_number" class="form-control form-control-lg shadow-none" placeholder="690126634">
                                <?php if (isset($erreur_champ) && empty($_POST['phone_number'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg shadow-none" placeholder="************">
                                <?php if (isset($erreur_champ) && empty($_POST['password'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-customize btn-lg btn-responsive text-white w-100">
                                    Créer votre compte
                                </button>
                            </div>

                            <!-- Link to Login Page -->
                            <div class="text-center">
                                <span>Vous avez déjà un compte ? 
                                    <a href="login.php" class="text-decoration-none text-primary">Se connecter</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add this script to enable reCAPTCHA functionality -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="script.js"></script>


</body>
</html>