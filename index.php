<?php
// Activer le rapport d'erreurs pour faciliter le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérification du paramètre `lang`
$allowed_languages = ['uk', 'fr', 'it', 'en'];
$language = isset($_GET['lang']) && in_array($_GET['lang'], $allowed_languages) ? $_GET['lang'] : 'fr';

// Fonction pour charger la langue préférée de l'utilisateur
function load_user_preferred_language($mysqli) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = $mysqli->prepare("SELECT preferred_language FROM users WHERE id = ?");
        $query->bind_param("i", $user_id);
        $query->execute();
        $query->bind_result($preferred_language);
        if ($query->fetch()) {
            return $preferred_language;
        }
    }
    return 'fr'; // Langue par défaut
}

// Charger la langue préférée de l'utilisateur
include 'db.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $language = load_user_preferred_language($mysqli);
} else {
    $language = isset($_GET['lang']) && in_array($_GET['lang'], $allowed_languages) ? $_GET['lang'] : 'fr';
}

// Charger les traductions
$translations = include __DIR__ . "/lang/{$language}.php";

// Debug : Afficher la langue sélectionnée
echo "<script>console.log('Langue sélectionnée par PHP: " . $language . "');</script>";

// Déterminer la page à charger et le jeu correspondant
$allowed_pages = ['home', 'actif_business', 'actif_ideas', 'contact', 'about', 'login', 'warhammer40k', 'warhammer', 'register', 'profile'];
$page = isset($_GET['page']) && in_array($_GET['page'], $allowed_pages) ? $_GET['page'] : 'home';

// Définir le jeu en fonction de la page
$game = '';
if ($page === 'warhammer40k') {
    $game = 'Warhammer 40k';
} elseif ($page === 'warhammer') {
    $game = 'Warhammer';
}

// Inclure le fichier correspondant
switch ($page) {
  case 'home':
    include 'pages/home.php';
    break;
  case 'login':
    include 'pages/login.php';
    break;
  case 'warhammer40k':
    $game = 'Warhammer 40k';
    include 'pages/warhammer40k.php';
    break;
  case 'warhammer':
    $game = 'Warhammer';
    include 'pages/warhammer.php';
    break;
  case 'register':
    include 'pages/register.php';
    break;
  case 'profile':
    include 'pages/profil.php';
    break;
  case 'actif_business':
    include 'pages/actif_business.php';
    break;
  case 'actif_ideas':
    include 'pages/actif_ideas.php';
    break;
  case 'contact':
    include 'pages/contact.php';
    break;
  case 'about':
    include 'pages/about.php';
    break;
  default:
    include 'pages/404.php';
    break;
}
?>