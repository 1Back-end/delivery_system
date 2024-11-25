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
            
    <?php include_once("process_login_users.php"); ?>
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


                    <!-- Form section -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="" method="post">
                            <div class="mb-3">
                                <h5 class="fw-bold">Connectez-vous à votre compte !</h5>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg shadow-none" placeholder="mail@example.com" />
                                <?php if (isset($erreur_champ) && empty($_POST['email'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg shadow-none" placeholder="************" />
                                <?php if (isset($erreur_champ) && empty($_POST['password'])): ?>
                                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                                <?php endif; ?>
                            </div>
                            <!-- <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="6LdM-IcqAAAAALzPZEO6dVQ5mks4goeKedtARA6A"></div>
                            </div> -->
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-customize btn-responsive btn-lg text-white w-100">
                                    Se connecter
                                </button>
                            </div>
                            <div class="text-center">
                                <a href="forgot_password.php" class="text-decoration-none text-primary d-block mb-2">
                                    Mot de passe oublié ?
                                </a>
                            </div>
                            <div class="text-center">
                                <span>
                                    Vous n'avez pas de compte ? 
                                    <a href="register.php" class="text-decoration-none text-primary">Créez-en un</a>
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