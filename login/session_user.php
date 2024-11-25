<?php
session_start();

// Vérifier si l'utilisateur est connecté et si son rôle est 'admin' sur la même ligne
if (!isset($_SESSION["uuid"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/login.php");
    exit();
}
?>
