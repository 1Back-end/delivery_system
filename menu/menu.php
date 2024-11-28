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
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

	

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input shadow-none" placeholder="Search Here">
					</div>
				</form>
			</div>
		</div>
		
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<!--  -->
			</div>
			<div class="user-notification">
				<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						
				</a>
					<div class="dropdown-menu dropdown-menu-right">
						
					</div>
				</div>
			</div>
			<?php include '../login/session_admin.php'; ?>
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
					<a class="dropdown-item" href="../login/logout.php"><i class="fa fa-sign-out-alt"></i> Log Out</a>

					</div>
				</div>
			</div>
			
		</div>
	</div>

	

<?php include('../admin/lang.php'); ?>
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
                <!-- <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-language"></span><span class="mtext"><?php echo $selected_lang['system_language']; ?></span>
                    </a>
                    <ul class="submenu">
                        <li><a href="?lang=fr"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/2560px-Flag_of_France.svg.png" alt="Français" width="30" height="20"> Français</a></li>
                        <li><a href="?lang=en"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg" alt="Anglais" width="30" height="20"> Anglais</a></li>
                    </ul>
                </li> -->

                <li>
                    <a href="../admin/dashboard.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-tachometer-alt"></span><span class="mtext"><?php echo $selected_lang['dashboard']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/drivers.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-id-badge"></span><span class="mtext"><?php echo $selected_lang['drivers']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/packages.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-box-open"></span><span class="mtext"><?php echo $selected_lang['packages']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/warehouses.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-store"></span><span class="mtext"><?php echo $selected_lang['warehouses']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/clients.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-user-friends"></span><span class="mtext"><?php echo $selected_lang['clients']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/tracking.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-map-marked-alt"></span><span class="mtext"><?php echo $selected_lang['tracking']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="../admin/car.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-car"></span><span class="mtext"><?php echo $selected_lang['car']; ?></span>
                    </a>
                </li>
                <!-- <li>
                    <a href="../admin/carriers.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-truck-loading"></span><span class="mtext"><?php echo $selected_lang['carriers']; ?></span>
                    </a>
                </li> -->
                <li>
                    <a href="../admin/reports.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-chart-line"></span><span class="mtext"><?php echo $selected_lang['reports']; ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-map"></span><span class="mtext"><?php echo $selected_lang['locations']; ?></span>
                    </a>
                    <ul class="submenu">
                        <li><a href="../admin/regions.php"><?php echo $selected_lang['manage_regions']; ?></a></li>
                        <li><a href="../admin/villes.php"><?php echo $selected_lang['manage_cities']; ?></a></li>
                        <li><a href="../admin/quartiers.php"><?php echo $selected_lang['manage_neighborhoods']; ?></a></li>
                    </ul>
                </li>

                <!-- Dropdown Paramètres -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <span class="micon fa fa-cogs"></span><span class="mtext"><?php echo $selected_lang['settings']; ?></span>
                    </a>
                    <ul class="submenu">
                        <li><a href="../admin/general_settings.php"><span class="micon fa fa-tools"></span> <?php echo $selected_lang['general_settings']; ?></a></li>
                        <li><a href="../admin/user_management.php"><span class="micon fa fa-user-cog"></span> <?php echo $selected_lang['user_management']; ?></a></li>
                        <li><a href="../admin/notifications.php"><span class="micon fa fa-bell"></span> <?php echo $selected_lang['notifications']; ?></a></li>
                        <li><a href="../admin/security.php"><span class="micon fa fa-shield-alt"></span> <?php echo $selected_lang['security']; ?></a></li>
                        <li><a href="../admin/language.php"><span class="micon fa fa-language"></span> <?php echo $selected_lang['system_language']; ?></a></li>
						<li><a href="../admin/smtp.php"><span class="micon fa fa-envelope"></span> <?php echo $selected_lang['smtp']; ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

		<!-- js -->
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../vendors/scripts/dashboard.js"></script>
</body>
</html>