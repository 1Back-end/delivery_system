<?php
include_once("../database/database.php");

// Récupérer toutes les langues disponibles
function get_all_languages($pdo) {
    $query = "SELECT * FROM languages WHERE is_deleted = 0 ORDER BY name ASC";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
