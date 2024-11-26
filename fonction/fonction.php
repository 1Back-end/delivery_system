<?php
include_once("../database/database.php");


function get_all_languages($pdo){
    $query = "SELECT * FROM languages WHERE is_deleted = 0 ORDER BY name ASC";
    $stmt = $pdo->query($query);
    $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $languages;
}
$all_languages = get_all_languages($pdo);

function get_informations_smtp($pdo){
    // Requête pour récupérer les informations SMTP
    $query = "SELECT * FROM smtp_settings WHERE is_deleted = 0 LIMIT 1"; // Limiter à un seul résultat
    $stmt = $pdo->query($query);
    $information_smtp = $stmt->fetch(PDO::FETCH_ASSOC);
    return $information_smtp; // Retourner les informations récupérées
}

function get_count_warehouses($pdo) {
    try {
        $query = "SELECT COUNT(*) as count FROM warehouses WHERE is_deleted = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier si le résultat a bien été récupéré
        if ($result) {
            return $result['count']; // Retourner directement la valeur du count
        } else {
            return 0; // Si aucun résultat, retourner 0
        }
    } catch (PDOException $e) {
        // En cas d'erreur avec la requête, on peut gérer l'erreur ici
        echo "Error: " . $e->getMessage();
        return 0;
    }
}
$warehouses = get_count_warehouses($pdo);


function get_all_warehouses($pdo, $limit, $offset){
    $query = "SELECT * FROM warehouses WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Calcul du nombre total d'entrepôts
function get_warehouses_count($pdo) {
    $query = "SELECT COUNT(*) FROM warehouses WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    return $stmt->fetchColumn();
}

function get_count_drivers($pdo){
    $query = "SELECT COUNT(*) as count FROM drivers WHERE is_deleted = 0";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si le résultat a bien été récupéré
    if ($result) {
        return $result['count']; // Retourner directement la valeur du count
    } else {
        return 0; // Si aucun résultat, retourner 0
    }

}
$count_drivers = get_count_drivers($pdo);

function get_warehouses_active($pdo){
    $query = "SELECT * FROM warehouses WHERE is_deleted = 0 AND status = 'active'";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$all_warehouses_active = get_warehouses_active($pdo);

function get_all_drivers($pdo, $limit, $offset) {
    $query = "
        SELECT 
            drivers.uuid AS driver_uuid, 
            drivers.num_drivers, 
            drivers.firstname, 
            drivers.lastname, 
            drivers.phone, 
            drivers.email, 
            warehouses.name AS warehouse_name, 
            warehouses.logo AS warehouse_logo 
        FROM drivers
        LEFT JOIN warehouses ON drivers.warehouse_uuid = warehouses.uuid 
        WHERE drivers.is_deleted = 0 
        ORDER BY drivers.created_at DESC
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_drivers($pdo) {
    $query = "SELECT COUNT(*) FROM drivers WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    return $stmt->fetchColumn();
}

function get_all_regions($pdo, $page = 1, $limit = 5) {
    $offset = ($page - 1) * $limit;
    $query = "SELECT * FROM regions ORDER BY name ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer la page actuelle, si aucune page n'est définie, commencer à la page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$regions = get_all_regions($pdo, $page);

function get_total_regions($pdo) {
    $query = "SELECT COUNT(*) FROM regions";
    $stmt = $pdo->query($query);
    return $stmt->fetchColumn();
}

$total_regions = get_total_regions($pdo);
$limit = 5;
$total_pages = ceil($total_regions / $limit);


function get_region_for_city($pdo){
    $query = "SELECT * FROM regions ORDER BY name ASC";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$region_for_city = get_region_for_city($pdo);


function get_city_with_region($pdo, $limit, $offset) {
    // Requête SQL pour obtenir les villes et les régions associées avec pagination
    $query = "
        SELECT cities.uuid AS city_uuid, cities.name AS city_name, regions.name AS region_name, cities.created_at
        FROM cities
        JOIN regions ON cities.region_uuid = regions.uuid
        WHERE cities.is_deleted = 0
        ORDER BY cities.created_at DESC
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Retourner les résultats
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_city_count($pdo) {
    // Compter le nombre total de villes (pour la pagination)
    $query = "SELECT COUNT(*) AS total FROM cities WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function get_city_with_is_deleted($pdo){
    $query = "SELECT * FROM cities WHERE is_deleted = 0 ORDER BY name ASC";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
$all_city_not_deleted = get_city_with_is_deleted($pdo);


function get_neighborhood_with_city($pdo, $page = 1, $perPage = 10) {
    // Calculer la position pour la pagination
    $start = ($page - 1) * $perPage;

    // Requête pour récupérer les villes et leurs quartiers
    $query = "
        SELECT c.name AS city_name, n.name AS neighborhood_name, n.created_at, n.uuid AS neighborhood_uuid
        FROM neighborhoods n
        JOIN cities c ON n.city_uuid = c.uuid
        LIMIT :start, :perPage
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les résultats
    $neighborhoods = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour compter le nombre total de quartiers pour la pagination
    $countQuery = "SELECT COUNT(*) FROM neighborhoods";
    $countStmt = $pdo->query($countQuery);
    $totalCount = $countStmt->fetchColumn();

    return [
        'data' => $neighborhoods,
        'total' => $totalCount
    ];
}


function generateDriverCode($prefix = "DRV") {
    // Préfixe pour le code (par défaut "DRV")
    $prefix = strtoupper($prefix);
    
    // Date actuelle sous le format YYYYMMDD
    $date = date('Y');
    
    // Générer un identifiant aléatoire unique
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
    
    // Code complet du chauffeur
    $driverCode = "{$prefix}{$date}{$uniqueId}";
    
    return $driverCode;
}

function generateParcelCode($prefix = "COL") {
    // Préfixe pour le code (par défaut "COL")
    $prefix = strtoupper($prefix);
    
    // Date actuelle sous le format YYYYMMDD
    $date = date('Ymd');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
    
    // Code complet du colis
    $parcelCode = "{$prefix}-{$date}-{$uniqueId}";
    
    return $parcelCode;
}

function generateDeliveryCode($prefix = "DLV") {
    // Préfixe pour le code (par défaut "DLV" pour Delivery)
    $prefix = strtoupper($prefix);
    
    // Date actuelle au format YYYYMMDD
    $date = date('Ymd');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    
    // Combiner les éléments pour former le code
    $deliveryCode = "{$prefix}-{$date}-{$uniqueId}";
    
    return $deliveryCode;
}

function generateWarehouseCode($prefix = "WH") {
    // Préfixe pour le code (par défaut "WH" pour Warehouse)
    $prefix = strtoupper($prefix);
    
    // Date actuelle au format YYYYMMDD
    $date = date('Y');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
    
    // Combiner les éléments pour former le code
    $warehouseCode = "{$prefix}{$date}{$uniqueId}";
    
    return $warehouseCode;
}
function generateCarrierCode($prefix = "CAR") {
    // Préfixe pour le code (par défaut "CAR" pour Carrier)
    $prefix = strtoupper($prefix);
    
    // Date actuelle au format YYYYMMDD
    $date = date('Ymd');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    
    // Combiner les éléments pour former le code
    $carrierCode = "{$prefix}-{$date}-{$uniqueId}";
    
    return $carrierCode;
}
function generateReportCode($prefix = "RPT") {
    // Préfixe pour le code (par défaut "RPT" pour Report)
    $prefix = strtoupper($prefix);
    
    // Date actuelle au format YYYYMMDD
    $date = date('Ymd');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    
    // Combiner les éléments pour former le code
    $reportCode = "{$prefix}-{$date}-{$uniqueId}";
    
    return $reportCode;
}
function generateNotificationCode($prefix = "NTF") {
    // Préfixe pour le code (par défaut "NTF" pour Notification)
    $prefix = strtoupper($prefix);
    
    // Date actuelle au format YYYYMMDD
    $date = date('Ymd');
    
    // Générer un identifiant unique aléatoire
    $uniqueId = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    
    // Combiner les éléments pour former le code
    $notificationCode = "{$prefix}-{$date}-{$uniqueId}";
    
    return $notificationCode;
}
function generateUUID4() {
    // Générer un UUID4 conforme RFC4122
    $data = random_bytes(16);

    // Modifier certains bits pour garantir que l'UUID est de type 4
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);  // 4 bits pour la version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);  // 2 bits pour la variante

    // Convertir en format hexadécimal et assembler l'UUID
    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    
    return $uuid;
}
function generateStrongPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+=<>?';
    $password = '';
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }
    
    return $password;
}
function generateFourDigitCode() {
    // Générer un code à 4 chiffres (de 1000 à 9999)
    $code = rand(1000, 9999);
    
    return $code;
}
function generateRandomYear($startYear = 1900, $endYear = null) {
    // Si l'année de fin n'est pas définie, utiliser l'année actuelle
    if ($endYear === null) {
        $endYear = date('Y'); // Récupérer l'année actuelle
    }
    
    // Générer une année aléatoire entre $startYear et $endYear
    $year = rand($startYear, $endYear);
    
    return $year;
}

// Exemple d'utilisation
// echo generateRandomYear(); // Exemple de résultat : 1983
function generateRandomDateTime($startYear = 2000, $endYear = null) {
    // Si l'année de fin n'est pas définie, utiliser l'année actuelle
    if ($endYear === null) {
        $endYear = date('Y'); // Récupérer l'année actuelle
    }

    // Générer une année, mois, jour, heure, minute, seconde aléatoire
    $year = rand($startYear, $endYear);
    $month = rand(1, 12);
    $day = rand(1, 28); // Pour éviter les problèmes de dates non existantes, on limite à 28 jours
    $hour = rand(0, 23);
    $minute = rand(0, 59);
    $second = rand(0, 59);

    // Créer une date au format Y-m-d H:i:s
    $randomDateTime = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $minute, $second);
    
    return $randomDateTime;
}

// Exemple d'utilisation
// echo generateRandomDateTime(); // Exemple de résultat : 2012-05-14 08:32:14
function generateUniqueCodeForRecipientOrSender() {
    // Générer un UUID v4 (identifiant unique universel)
    $uuid = bin2hex(random_bytes(16));  // Génère un UUID aléatoire
    return strtoupper($uuid);  // Retourne en majuscules
}

// Exemple d'utilisation
// echo generateUniqueCodeForRecipientOrSender(); // Exemple de résultat : 1B4D0A23F5E3E17A23A6A1D420AB156F
function generateUserUUID() {
    // Générer un UUID v4 (identifiant unique universel)
    $uuid = bin2hex(random_bytes(16));  // Génère un UUID aléatoire
    return strtoupper($uuid);  // Retourne en majuscules
}

// // Exemple d'utilisation
// echo generateUserUUID(); // Exemple de résultat : 5F4E7D83D23A4E1A9C9BEB9D2D5489A7
