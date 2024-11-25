<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<?php
// Récupérer les informations SMTP depuis la base de données
$information_smtp = get_informations_smtp($pdo);
?>

<div class="main-container mt-3 pb-3">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <!-- SMTP Settings Header -->
            <div class="mb-3">
                <h6 class="text-uppercase font-14"><?php echo htmlspecialchars($selected_lang['smtp']); ?></h6>
            </div>
            
            <!-- SMTP Settings Form -->
            <div class="mb-3">
                <form action="" method="post">
                    <!-- Username Input -->
                    <div class="mb-3">
                        <label for="username"><?php echo htmlspecialchars($selected_lang['username']); ?>:</label>
                        <input type="text" id="username" name="username" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['username']); ?>" required>
                    </div>
                    
                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email"><?php echo htmlspecialchars($selected_lang['email']); ?>:</label>
                        <input type="email" id="email" name="email" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['email']); ?>" required>
                    </div>
                    
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name"><?php echo htmlspecialchars($selected_lang['name']); ?>:</label>
                        <input type="text" id="name" name="name" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['name']); ?>" required>
                    </div>
                    
                    <!-- Host Input -->
                    <div class="mb-3">
                        <label for="host"><?php echo htmlspecialchars($selected_lang['host']); ?>:</label>
                        <input type="text" id="host" name="host" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['host']); ?>" required>
                    </div>
                    
                    <!-- Port Input -->
                    <div class="mb-3">
                        <label for="port"><?php echo htmlspecialchars($selected_lang['port']); ?>:</label>
                        <input type="number" id="port" name="port" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['port']); ?>" required>
                    </div>
                    
                    <!-- Encryption Input -->
                    <div class="mb-3">
                        <label for="encryption"><?php echo htmlspecialchars($selected_lang['encryption']); ?>:</label>
                        <input type="text" id="encryption" name="encryption" class="form-control shadow-none" value="<?php echo htmlspecialchars($information_smtp['encryption']); ?>" required>
                    </div>
                    
                    <!-- Save Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-customize btn-responsive text-white"><?php echo htmlspecialchars($selected_lang['save_button']); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
