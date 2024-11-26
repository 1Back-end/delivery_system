<!DOCTYPE html>
<html>
<head>
	<!-- Basic admin Info -->
	<meta charset="utf-8">
	<title><?php echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
</head>
<body>



	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				
			</div>
			<div class="user-notification">
				<div class="dropdown">
					
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
						</div>
					</div>
				</div>
			</div>
            <?php include 'session_user.php'; ?>
			<div class="user-info-dropdown">
				<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon shadow-none">
						<img src="<?php echo !empty($_SESSION['photo']) ? $_SESSION['photo'] : 'https://i.pinimg.com/736x/06/99/21/069921662e3ecc7cf3fc51527c30801f.jpg'; ?>" alt="">
					</span>
					<span class="user-name font-14"><?php echo $_SESSION['fullname']; ?></span>
				</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i> Profile</a>
					
					</div>
				</div>
			</div>
			
		</div>
	</div>

	
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="#">
            <h3 class="text-white text-uppercase-responsive">ColisTrack</h3>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
    <div class="sidebar-menu">
        <ul id="accordion-menu">
            <!-- Menu pour envoyer un colis -->
            
            <!-- Menu pour consulter les colis en cours -->
            <li>
                <a href="mes_colis.php" class="dropdown-toggle no-arrow">
                    <span class="micon micon fas fa-box"></span><span class="mtext">Mes colis</span>
                </a>
            </li>
            <!-- Menu pour consulter les paiements effectués -->
            <li>
                <a href="mes_paiements.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-credit-card-alt"></span><span class="mtext">Mes paiements</span>
                </a>
            </li>
            <!-- Menu pour gérer les informations personnelles -->
            <li>
                <a href="mon_compte.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-user"></span><span class="mtext">Mon compte</span>
                </a>
            </li>
            <!-- Menu pour consulter l'historique des envois -->
            <li>
                <a href="historique_envois.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-history"></span><span class="mtext">Historique des envois</span>
                </a>
            </li>
            <!-- Menu pour suivre un colis -->
            <li>
                <a href="suivi_colis.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-truck-moving"></span><span class="mtext">Suivi de colis</span>
                </a>
            </li>
            <!-- Menu pour modifier les paramètres du compte utilisateur -->
            <li>
                <a href="parametres_compte.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-cogs"></span><span class="mtext">Paramètres du compte</span>
                </a>
            </li>
            <!-- Menu pour déconnecter l'utilisateur -->
            <li>
                <a href="../login/logout.php" class="dropdown-toggle no-arrow">
                    <span class="micon fas fa-sign-out-alt"></span><span class="mtext">Se déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
</div>

	</div>
	</div>
	</div>

	</div>
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../vendors/scripts/dashboard.js"></script>
	<script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="../vendors/scripts/steps-setting.js"></script>
</body>
</html>