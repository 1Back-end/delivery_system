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
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<div class="container mt-5 p-0">
    <div class="col-lg-6 col-sm-12 mx-auto">
        <div class="card-box p-4 shadow-none rounded bg-white">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img src="https://i.pinimg.com/736x/ad/7a/da/ad7adab67d67f034ecbe1b7897fab4fe.jpg" class="img-fluid rounded" alt="Illustration">
                </div>
                <div class="col-lg-6 col-sm-12 text-center">
                    <div class="mb-2">
                        <h5 class="text-uppercase font-18">ColisTrack</h5>
                    </div>
                    <div class="mb-3">
                        <p>Suivez vos colis en temps réel avec ColisTrack, la solution idéale pour une gestion efficace de vos envois et réceptions.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="login/login.php" class="btn btn-customize shadow-none border-0 text-white">
                    Cliqué pour continuer
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>