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
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="../vendors/images/img.jpg" class="shadow-none" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								
								
							
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon shadow-none">
							<img src="../vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">Laurent Dev</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="#">
				<h3 class="text-white text-uppercase-responsive">
				ColisTrack
				</h3>
                
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
				
                <li>
                    <a href="../admin/dashboard.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-tachometer-alt"></span><span class="mtext">Tableau de bord</span>
                    </a>
                </li>

                <!-- Gestion des colis -->
                <li>
                    <a href="../admin/packages.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-box"></span><span class="mtext">Gestion des colis</span>
                    </a>
                </li>

                <!-- Gestion des entrepôts -->
                <li>
                    <a href="../admin/warehouses.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-warehouse"></span><span class="mtext">Gestion des entrepôts</span>
                    </a>
                </li>

                <!-- Gestion des clients -->
                <li>
                    <a href="../admin/clients.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-users"></span><span class="mtext">Gestion des clients</span>
                    </a>
                </li>

                <!-- Suivi des livraisons -->
                <li>
                    <a href="../admin/tracking.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-map-marker-alt"></span><span class="mtext">Suivi des livraisons</span>
                    </a>
                </li>

                <!-- Gestion des transporteurs -->
                <li>
                    <a href="../admin/carriers.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-truck"></span><span class="mtext">Gestion des transporteurs</span>
                    </a>
                </li>

                <!-- Rapports -->
                <li>
                    <a href="../admin/reports.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-chart-bar"></span><span class="mtext">Rapports</span>
                    </a>
                </li>

                <!-- Paramètres -->
                <li>
                    <a href="../admin/settings.php" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-cogs"></span><span class="mtext">Paramètres</span>
                    </a>
                </li>
					
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		
								
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