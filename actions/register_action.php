<?php
include '../db.php';

$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$username = isset($_POST['commander_name']) ? $_POST['commander_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';
$commander_name = isset($_POST['commander_name']) ? $_POST['commander_name'] : '';
$favorite_game = isset($_POST['favorite_game']) && $_POST['favorite_game'] !== 'Null' ? $_POST['favorite_game'] : null;
$favorite_faction = isset($_POST['favorite_faction']) && $_POST['favorite_faction'] !== 'Null' ? $_POST['favorite_faction'] : null;
$preferred_language = isset($_POST['preferred_language']) ? $_POST['preferred_language'] : '';

// Vérification des champs requis
if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password) || empty($commander_name)) {
    echo "Tous les champs obligatoires doivent être remplis.";
    exit;
}

// Gestion de l'image de profil
$profile_image_url = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $profile_image_url = $target_file;
    }
}

// Vérifier si l'email, le nom d'utilisateur ou le nom de commandeur existe déjà
$query = $mysqli->prepare("SELECT id FROM users WHERE email = ? OR username = ? OR user_gamertag = ?");
$query->bind_param("sss", $email, $username, $commander_name);
$query->execute();
$query->store_result();

if ($query->num_rows > 0) {
    echo "L'email, le nom d'utilisateur ou le nom de commandeur est déjà utilisé.";
    exit;
}

// Insérer le nouvel utilisateur
$query = $mysqli->prepare("INSERT INTO users (first_name, last_name, username, email, password, user_gamertag, favorite_game, favorite_faction, profile_image_url, preferred_language) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$query->bind_param("ssssssssss", $first_name, $last_name, $username, $email, $password, $commander_name, $favorite_game, $favorite_faction, $profile_image_url, $preferred_language);

if ($query->execute()) {
    echo "Inscription réussie.";
} else {
    echo "Erreur lors de l'inscription.";
}
?>