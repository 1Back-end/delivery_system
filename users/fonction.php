<?php
include_once("../database/database.php");

function get_distinct_region($pdo) {
    $query = "SELECT DISTINCT uuid, name FROM regions WHERE is_deleted = 0 ORDER BY name";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC); // Récupère un tableau associatif
}
$regions = get_distinct_region($pdo);

function get_distinct_city($pdo){
    $query = "SELECT DISTINCT uuid, name FROM cities WHERE is_deleted = 0 ORDER BY name";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC); // Récupère un tableau associatif
}
$cities = get_distinct_city($pdo);

function get_distinct_neighborhoods($pdo){
    $query = "SELECT DISTINCT uuid, name FROM neighborhoods WHERE is_deleted = 0 ORDER BY name";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC); // Récupère un tableau associatif
}
$neighborhoods = get_distinct_neighborhoods($pdo);


$user_uuid = $_SESSION["uuid"];

function get_count_packages_users_uuid($pdo, $user_uuid){
    $query = "SELECT COUNT(*) FROM packages WHERE sender_uuid   = :user_uuid AND is_deleted = 0";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_uuid', $user_uuid);
    $statement->execute();
    return $statement->fetchColumn();
}
$count_packages_users_uuid = get_count_packages_users_uuid($pdo, $user_uuid);


function get_all_packages_users_uuid($pdo, $user_uuid, $page = 1, $perPage = 10) {
    // Calculer le décalage pour la pagination
    $offset = ($page - 1) * $perPage;

    // Requête pour récupérer les colis avec les informations du sender
    $query = "
        SELECT 
            p.uuid AS package_uuid,
            p.package_code,
            p.package_type,
            p.dimensions,
            p.weight,
            p.status,
            p.package_image,
            p.scheduled_delivery_date,
            p.created_at,
            u.firstname AS sender_firstname,
            u.lastname AS sender_lastname,
            u.email AS sender_email,
            u.phone_number  AS sender_contact
        FROM packages p
        JOIN users u ON p.sender_uuid = u.uuid
        WHERE p.sender_uuid = :user_uuid AND p.is_deleted = 0
        LIMIT :offset, :perPage
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':user_uuid', $user_uuid, PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getPackageTypes() {
    // Liste des types de colis disponibles
    $packageTypes = array(
        'Colis standard',
        'Colis fragile',
        'Colis express',
        'Colis encombrant',
        'Colis réfrigéré ou congelé',
        'Colis de valeur',
        'Colis international',
        'Colis sécurisé',
        'Colis léger',
        'Colis cadeau'
        );
        
    return $packageTypes;
}

// Exemple d'utilisation
$packageTypes = getPackageTypes();

// Fonction pour obtenir les dimensions des colis
function getPackageDimensions() {
    // Liste des dimensions des colis disponibles
    $packageDimensions = array(
        '20x10x5',
        '25x15x8',
        '30x20x10',
        '35x25x12',
        '40x30x15',
        '45x35x18',
        '50x40x20',
        '55x45x22',
        '60x50x25',
        '65x55x27'
        );
        
    return $packageDimensions;
}

// Récupérer les dimensions des colis
$packageDimensions = getPackageDimensions();