<?php
include_once("../database/database.php");

if (isset($_GET['region_uuid'])) {
    $region_uuid = $_GET['region_uuid'];

    $query = "SELECT uuid, name FROM cities WHERE region_uuid = :region_uuid ORDER BY name";
    $statement = $pdo->prepare($query);
    $statement->execute(['region_uuid' => $region_uuid]);
    $cities = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cities);
}
?>

