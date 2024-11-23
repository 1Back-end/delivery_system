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

<div class="container mt-5 pb-5 p-0">
    <div class="col-lg-6 col-sm-12 mb-3 mx-auto">
        <div class="card-box p-4 shadow-none bg-white">
            <div class="row">
                <!-- Image section -->
                <div class="col-lg-4 col-sm-12 d-flex align-items-center">
                    <img src="https://i.pinimg.com/736x/ad/7a/da/ad7adab67d67f034ecbe1b7897fab4fe.jpg" 
                         class="img-fluid d-none d-md-block w-100 rounded" 
                         style="max-height: 200px; object-fit: cover;" 
                         alt="Illustration">
                </div>

                <!-- Form section -->
                <div class="col-lg-8 col-sm-12">
                    <form action="" method="post">
                        <div class="mb-3">
                            <h5>Connectez-vous à votre compte !</h5>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control shadow-none" placeholder="690126634" />
                        </div>

                        <div class="mb-3">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control shadow-none" placeholder="************">
                        </div>
                        
                        <div class="mb-3">
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LdM-IcqAAAAALzPZEO6dVQ5mks4goeKedtARA6A"></div>
                        </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-customize btn-responsive text-white w-100">
                                Se connecter
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="forgot_password.php" class="text-decoration-none text-primary d-block mb-2">Mot de passe oublié ?</a>
                        </div>
                        <div class="text-center">
                            <span>Vous n'avez pas de compte? <a href="register.php" class="text-decoration-none text-primary">Créez-en un</a></span>
                        </div>
                    </form>
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