<?php
// language.php
session_start();

// Vérifier si une langue a été choisie dans l'URL
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;  // Stocker la langue dans la session
} elseif (!isset($_SESSION['lang'])) {
    // Par défaut, la langue est le français si aucune langue n'est choisie
    $_SESSION['lang'] = 'fr';
}

// Charger le fichier de langue en fonction de la langue sélectionnée
$lang_file = 'languages/lang_' . $_SESSION['lang'] . '.php';  // Chargement du fichier de langue

// Vérifier si le fichier existe
if (file_exists($lang_file)) {
    $translations = include($lang_file);  // Inclure le fichier de traduction
} else {
    // Si le fichier de langue n'est pas trouvé, charger le fichier français par défaut
    $translations = include('languages/lang_fr.php');
}
?>
