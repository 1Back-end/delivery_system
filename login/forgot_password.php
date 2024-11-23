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


<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card-box p-3 mt-3 shadow-none bg-white">
                <div class="row align-items-center">
                    <!-- Image section -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img src="https://i.pinimg.com/736x/ad/7a/da/ad7adab67d67f034ecbe1b7897fab4fe.jpg" 
                             class="img-fluid d-none d-md-block rounded w-100" 
                             style="max-height: 300px; object-fit: cover;" 
                             alt="Illustration">
                    </div>

                    <!-- Form section -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="" method="post">
                            <!-- Title and description -->
                            <div class="mb-3">
                                <h5>Réinitialiser votre mot de passe</h5>
                                <p class="font-12 mb-3">Entrez votre numéro de téléphone lié à votre compte pour réinitialiser votre mot de passe.</p>
                            </div>

                            <!-- Phone input -->
                            <div class="form-group col-lg-6 col-md-8 col-sm-12">
                                <label for="phone" class="form-label">Numéro de téléphone</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="form-control intl-tel-input form-control-lg shadow-none max-width-1000" 
                                       placeholder="690126634" required />
                            </div>

                            <!-- Submit button -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-customize btn-responsive text-white w-100">
                                    Réinitialiser le mot de passe
                                </button>
                            </div>

                            <!-- Link to login page -->
                            <div class="text-center">
                                <span class="font-14">Vous vous souvenez de votre mot de passe ? <a href="login.php" class="text-decoration-none text-primary">Se connecter</a></span>
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