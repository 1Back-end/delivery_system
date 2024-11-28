<?php
include_once("../database/database.php");

if (isset($_GET['city_uuid'])) {
    $city_uuid = $_GET['city_uuid'];

    $query = "SELECT uuid, name FROM neighborhoods WHERE city_uuid = :city_uuid ORDER BY name";
    $statement = $pdo->prepare($query);
    $statement->execute(['city_uuid' => $city_uuid]);
    $neighborhoods = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($neighborhoods);
}
?>
